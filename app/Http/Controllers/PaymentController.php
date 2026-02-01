<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * বুকিং ফর্ম দেখাবে (GET /payment/book)
     */
    public function bookForm(Request $request)
    {
        $roomId = $request->query('room_id');
        
        if (!$roomId) {
            return redirect()->route('frontend.rooms')->with('error', 'Please select a room first.');
        }
        
        $room = Room::where('status', 'Enabled')->findOrFail($roomId);
        
        return view('frontend.payment.book-form', compact('room'));
    }
    
    /**
     * বুকিং সাবমিট ও SSL Commerz ইনিশিয়েট (POST /payment/process)
     */
    public function processBooking(Request $request)
    {
        // Step 1: ভ্যালিডেশন
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'rooms' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'payment_method' => 'required|in:sslcommerz,cod,bank',
            'special_requests' => 'nullable|string'
        ]);
        
        // Step 2: রুম ডেটা পাওয়া
        $room = Room::findOrFail($request->room_id);
        
        // Step 3: ক্যালকুলেশন
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkOut->diffInDays($checkIn);
        
        $roomPrice = $room->offer_fare < $room->fare ? $room->offer_fare : $room->fare;
        $roomTotal = $roomPrice * $nights * $request->rooms;
        $vat = $roomTotal * 0.15;
        $serviceCharge = 10;
        $totalAmount = $roomTotal + $vat + $serviceCharge;
        
        // Step 4: বুকিং তৈরি
        $booking = Booking::create([
            'booking_reference' => 'BOOK-' . date('YmdHis') . '-' . strtoupper(Str::random(4)),
            'rooms_id' => $room->id,
            'user_id' => auth()->id(),
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adults' => $request->adults,
            'children' => $request->children ?? 0,
            'rooms' => $request->rooms,
            'total_nights' => $nights,
            'room_price' => $roomPrice,
            'total_amount' => $totalAmount,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'special_requests' => $request->special_requests,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'booking_status' => 'pending',
            'notes' => 'Booking created via website'
        ]);
        
        // Step 5: পেমেন্ট মেথড অনুযায়ী কাজ
        switch ($request->payment_method) {
            case 'sslcommerz':
                return $this->initiateSSLCommerz($booking, $totalAmount);
                
            case 'cod':
                $booking->update([
                    'payment_status' => 'pending',
                    'booking_status' => 'confirmed'
                ]);
                return redirect()->route('payment.success', $booking->id)
                    ->with('success', 'Booking confirmed! Please pay at the hotel.');
                
            case 'bank':
                return redirect()->route('payment.bank', $booking->id)
                    ->with('info', 'Please complete bank transfer.');
                
            default:
                return redirect()->route('payment.success', $booking->id);
        }
         switch ($request->payment_method) {
        case 'sslcommerz':
            return $this->initiateSSLCommerz($booking, $totalAmount);
            
        case 'cod':
            $booking->update([
                'payment_status' => 'pending',
                'booking_status' => 'confirmed'
            ]);
            return redirect()->route('payment.success', $booking->id)
                ->with('success', 'Booking confirmed! Please pay at the hotel.');
            
        case 'bank':
            return redirect()->route('payment.bank', $booking->id)
                ->with('info', 'Please complete bank transfer.')
                ->with('booking_reference', $booking->booking_reference);
            
        default:
            return redirect()->route('payment.success', $booking->id);
    }
    }
    
    /**
     * SSL Commerz পেমেন্ট ইনিশিয়েট
     */
    private function initiateSSLCommerz($booking, $amount)
    {
        // SSL Commerz API ডেটা
        $post_data = array();
        $post_data['store_id'] = env('SSLC_STORE_ID', 'testbox');
        $post_data['store_passwd'] = env('SSLC_STORE_PASSWORD', 'qwerty');
        $post_data['total_amount'] = number_format($amount, 2, '.', '');
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $booking->booking_reference;
        $post_data['success_url'] = route('payment.ssl.success');
        $post_data['fail_url'] = route('payment.ssl.fail');
        $post_data['cancel_url'] = route('payment.ssl.cancel');
        $post_data['ipn_url'] = route('payment.ssl.ipn');
        
        // গ্রাহকের তথ্য
        $post_data['cus_name'] = $booking->customer_name;
        $post_data['cus_email'] = $booking->customer_email;
        $post_data['cus_add1'] = $booking->customer_address ?? 'N/A';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $booking->customer_phone;
        $post_data['cus_fax'] = "";
        
        // পণ্যের তথ্য
        $post_data['product_name'] = "Hotel Room Booking - " . $booking->room->name;
        $post_data['product_category'] = "Hotel Service";
        $post_data['product_profile'] = "non-physical-goods";
        
        // শিপিং তথ্য
        $post_data['shipping_method'] = "NO";
        $post_data['num_of_item'] = 1;
        $post_data['product_name'] = "Room Booking";
        $post_data['product_category'] = "Booking";
        $post_data['product_profile'] = "non-physical-goods";
        
        // API কল
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php');
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        
        $content = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        
        if ($code == 200 && !curl_errno($handle)) {
            curl_close($handle);
            $sslcommerzResponse = json_decode($content, true);
            
            if (isset($sslcommerzResponse['GatewayPageURL']) && $sslcommerzResponse['GatewayPageURL'] != "") {
                // SSL Commerz পেজে রিডাইরেক্ট
                return redirect($sslcommerzResponse['GatewayPageURL']);
            } else {
                // Error হ্যান্ডলিং
                return redirect()->route('payment.fail')
                    ->with('error', 'SSL Commerz configuration error: ' . ($sslcommerzResponse['failedreason'] ?? 'Unknown error'));
            }
        } else {
            curl_close($handle);
            return redirect()->route('payment.fail')
                ->with('error', 'Failed to connect to SSL Commerz. Please try again.');
        }
    }
    
    /**
     * SSL Commerz Success Callback
     */
    public function sslSuccess(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $val_id = $request->input('val_id');
        $amount = $request->input('amount');
        $card_type = $request->input('card_type');
        
        // বুকিং খুঁজুন
        $booking = Booking::where('booking_reference', $tran_id)->firstOrFail();
        
        // পেমেন্ট স্ট্যাটাস আপডেট
        $booking->update([
            'payment_status' => 'paid',
            'booking_status' => 'confirmed',
            'notes' => 'Payment completed via SSL Commerz. Transaction ID: ' . $val_id . ', Card: ' . $card_type
        ]);
        
        // সাকসেস পেজে রিডাইরেক্ট
        return redirect()->route('payment.success', $booking->id)
            ->with('success', 'Payment completed successfully!');
    }
    
    /**
     * SSL Commerz Fail Callback
     */
    public function sslFail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        
        $booking = Booking::where('booking_reference', $tran_id)->firstOrFail();
        $booking->update([
            'payment_status' => 'failed',
            'notes' => 'Payment failed via SSL Commerz'
        ]);
        
        return redirect()->route('payment.fail')
            ->with('error', 'Payment failed. Please try again.');
    }
    
    /**
     * SSL Commerz Cancel Callback
     */
    public function sslCancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        
        $booking = Booking::where('booking_reference', $tran_id)->firstOrFail();
        $booking->update([
            'payment_status' => 'cancelled',
            'booking_status' => 'cancelled',
            'notes' => 'Payment cancelled by user'
        ]);
        
        return redirect()->route('payment.cancel')
            ->with('info', 'Payment cancelled. You can book again.');
    }
    
    /**
     * SSL Commerz IPN (Instant Payment Notification)
     */
    public function sslIPN(Request $request)
    {
        // SSL Commerz IPN ভেরিফিকেশন
        $store_id = env('SSLC_STORE_ID', 'testbox');
        $store_passwd = env('SSLC_STORE_PASSWORD', 'qwerty');
        
        $tran_id = $request->input('tran_id');
        $val_id = $request->input('val_id');
        
        // IPN ভেরিফিকেশন API কল
        $url = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php";
        $data = [
            'val_id' => $val_id,
            'store_id' => $store_id,
            'store_passwd' => $store_passwd,
            'format' => 'json'
        ];
        
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        
        $content = curl_exec($handle);
        curl_close($handle);
        
        $result = json_decode($content, true);
        
        if (isset($result['status']) && $result['status'] == 'VALID') {
            $booking = Booking::where('booking_reference', $tran_id)->first();
            if ($booking) {
                $booking->update([
                    'payment_status' => 'paid',
                    'booking_status' => 'confirmed',
                    'notes' => 'Payment verified via IPN. Amount: ' . $result['amount']
                ]);
            }
        }
        
        return response()->json(['status' => 'OK']);
    }
    
    /**
     * পেমেন্ট সাকসেস পেজ
     */
    public function success($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        return view('frontend.payment.success', compact('booking'));
    }
    
    /**
     * পেমেন্ট ফেইল পেজ
     */
    public function fail()
    {
        return view('frontend.payment.fail');
    }
    
    /**
     * পেমেন্ট ক্যান্সেল পেজ
     */
    public function cancel()
    {
        return view('frontend.payment.cancel');
    }
    
    /**
     * ব্যাংক ট্রান্সফার তথ্য
     */
    public function bankTransfer($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        
        $bankInfo = [
            'bank_name' => 'Your Bank Name',
            'account_name' => 'Your Hotel Name',
            'account_number' => '1234567890123',
            'branch' => 'Main Branch',
            'routing_number' => '123456789',
            'swift_code' => 'ABCDEFGH'
        ];
        
        return view('frontend.payment.bank-transfer', compact('booking', 'bankInfo'));
    }
    
    /**
     * পেমেন্ট স্ট্যাটাস চেক
     */
    public function checkStatus($reference)
    {
        $booking = Booking::where('booking_reference', $reference)->firstOrFail();
        
        return response()->json([
            'status' => true,
            'booking' => $booking,
            'payment_status' => $booking->payment_status,
            'booking_status' => $booking->booking_status
        ]);
    }
}