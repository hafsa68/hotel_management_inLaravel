@extends('backend.layouts.app')
@section('head')

    <head>
        <meta charset="utf-8" />
        <title>All Amenities | Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Myra Studio" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('') }}/assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ url('') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
        <link href="{{ url('') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <script src="{{ url('') }}/assets/js/config.js"></script>
    </head>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- 
       ===================================================================
       1. CSS & STYLES
       =================================================================== 
    --}}
        <link href="{{ url('') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <style>
            .room-selector {
                transition: 0.2s;
                cursor: pointer;
            }

            .room-selector:hover {
                transform: scale(1.05);
            }

            .selected-room {
                border: 3px solid #5e3fc9 !important;
                background-color: #5e3fc9 !important;
                color: white !important;
                box-shadow: 0 0 10px rgba(94, 63, 201, 0.5);
            }

            .disabled-room {
                cursor: not-allowed;
                opacity: 0.6;
            }
        </style>

        {{-- 
       ===================================================================
       2. PAGE CONTENT
       =================================================================== 
    --}}

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h3 class="card-title m-0 font-weight-bold text-primary">Book Room</h3>
                <a href="{{ route('request.index') }}" class="btn btn-outline-primary btn-sm ml-auto">
                    <i class="fa fa-list"></i> All Bookings
                </a>
            </div>

            <div class="card-body">
                {{-- SEARCH FORM --}}
                <form action="{{ route('book.search') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold">Check In - Check Out</label>
                                <input type="text" name="dates" id="booking_dates" class="form-control"
                                    value="{{ request('dates') }}" required autocomplete="off"
                                    placeholder="Select Date Range">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold">Room Type <span class="text-danger">*</span></label>
                                <select name="rooms_id" id="room_type_select" class="form-control" required>
                                    <option value="">-- Select Room Type --</option>
                                    @foreach ($roomTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ request('rooms_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }} (Fare: {{ $type->fare }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold">Availability: <span class="badge badge-info"
                                        id="available_count">0</span></label>
                                <input type="number" name="quantity" class="form-control" placeholder="Check capacity..."
                                    value="{{ request('quantity') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="background-color: #5e3fc9; border: none;">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>

                {{-- SEARCH RESULTS SECTION --}}
                @if (isset($allRoomNumbers))
                    <hr class="my-4">
                    <div class="row">
                        {{-- LEFT SIDE: GRID SELECTION --}}
                        <div class="col-md-8">
                            <h5 class="mb-3 border-bottom pb-2">Select a Room <small
                                    class="text-muted">({{ $selectedRoomType->name }})</small></h5>
                            @if ($allRoomNumbers->isEmpty())
                                <div class="alert alert-warning">No physical rooms found for this category.</div>
                            @else
                                <div class="d-flex flex-wrap">
                                    @foreach ($allRoomNumbers as $room)
                                        @php $isBooked = in_array($room->id, $bookedRoomIds); @endphp
                                        <div class="room-selector m-2 p-3 text-center rounded shadow-sm border {{ $isBooked ? 'bg-danger text-white disabled-room' : 'bg-light text-dark' }}"
                                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-weight: bold; position: relative;"
                                            data-id="{{ $room->id }}"
                                            data-no="{{ $room->room_number ?? $room->room_no }}">
                                            {{ $room->room_number ?? $room->room_no }}
                                            <div
                                                style="font-size: 10px; position: absolute; bottom: 5px; color: {{ $isBooked ? 'white' : '#28a745' }};">
                                                {{ $isBooked ? 'BOOKED' : 'FREE' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- RIGHT SIDE: GUEST FORM --}}
                        <div class="col-md-4">
                            <div class="card shadow border-0" style="background-color: #f8f9fa;">
                                <div class="card-header bg-dark text-white font-weight-bold"><i class="fa fa-user"></i>
                                    Guest Details</div>
                                <div class="card-body">
                                    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                                        @csrf
                                        <input type="hidden" name="rooms_id" value="{{ request('rooms_id') }}">
                                        <input type="hidden" name="room_nos_id" id="room_nos_id" required>
                                        <input type="hidden" name="check_in" value="{{ $checkIn }}">
                                        <input type="hidden" name="check_out" value="{{ $checkOut }}">

                                        <div class="alert alert-info p-2 mb-3" style="font-size: 14px;">
                                            <strong>Dates:</strong> {{ date('d M', strtotime($checkIn)) }} -
                                            {{ date('d M', strtotime($checkOut)) }}
                                        </div>

                                        {{-- NEW FIELD: DROPDOWN SELECTION --}}
                                        <div class="form-group">
                                            <label class="font-weight-bold text-primary">Selected Room Number <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control font-weight-bold" id="manual_room_select">
                                                <option value="">-- Choose from List --</option>
                                                @foreach ($allRoomNumbers as $room)
                                                    @php $isBooked = in_array($room->id, $bookedRoomIds); @endphp
                                                    {{-- Only show Available rooms in dropdown --}}
                                                    @if (!$isBooked)
                                                        <option value="{{ $room->id }}">
                                                            {{ $room->room_number ?? $room->room_no }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <small class="text-muted">You can click the boxes on the left OR select
                                                here.</small>
                                            <small class="text-danger" id="room_error"
                                                style="display:none; display:block;">Please select a room!</small>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label>Guest Name <span class="text-danger">*</span></label>
                                            <input type="text" name="guest_name" class="form-control" required
                                                placeholder="Full Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email / Phone</label>
                                            <input type="text" name="guest_email" class="form-control"
                                                placeholder="Optional">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block btn-lg shadow-sm mt-4"
                                            onclick="return validateRoomSelection()">Confirm Booking</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- 
       ===================================================================
       3. JAVASCRIPT
       =================================================================== 
    --}}

    @section('scripts')
        <script src="{{ url('') }}/assets/js/vendor.min.js"></script>
        <script src="{{ url('') }}/assets/js/app.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(document).ready(function() {
                // 1. Initialize DatePicker
                $('#booking_dates').daterangepicker({
                    autoUpdateInput: false,
                    minDate: new Date(),
                    locale: {
                        cancelLabel: 'Clear',
                        format: 'MM/DD/YYYY'
                    }
                });

                $('#booking_dates').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                        'MM/DD/YYYY'));
                });
                $('#booking_dates').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // 2. Availability Check
                $('#room_type_select').on('change', function() {
                    let roomId = $(this).val();
                    if (roomId) {
                        $.ajax({
                            url: "{{ url('/admin/get-room-count') }}/" + roomId,
                            type: "GET",
                            success: function(data) {
                                $('#available_count').text(data.count);
                            },
                            error: function() {
                                $('#available_count').text('0');
                            }
                        });
                    }
                });

                // 3. SYNC LOGIC: When Grid Box is Clicked
                $('.room-selector').click(function() {
                    if ($(this).hasClass('bg-danger')) {
                        alert('Room already booked!');
                        return;
                    }
                    // Highlight Box
                    $('.room-selector').removeClass('selected-room bg-primary').not('.bg-danger').addClass(
                        'bg-light text-dark');
                    $(this).removeClass('bg-light text-dark').addClass('selected-room');

                    // Update Hidden ID
                    let id = $(this).data('id');
                    $('#room_nos_id').val(id);
                    $('#room_error').hide();

                    // Update Dropdown to match Box
                    $('#manual_room_select').val(id);
                });

                // 4. SYNC LOGIC: When Dropdown is Changed
                $('#manual_room_select').on('change', function() {
                    let id = $(this).val();

                    // Update Hidden ID
                    $('#room_nos_id').val(id);

                    if (id) {
                        $('#room_error').hide();
                        // Find the box with this ID and click it (to trigger visual highlight)
                        // We use trigger handler to avoid infinite loop or just manually add class
                        $('.room-selector').removeClass('selected-room bg-primary').not('.bg-danger').addClass(
                            'bg-light text-dark');
                        let targetBox = $('.room-selector[data-id="' + id + '"]');
                        targetBox.removeClass('bg-light text-dark').addClass('selected-room');
                    } else {
                        // If they selected "Choose from list", clear highlight
                        $('.room-selector').removeClass('selected-room bg-primary').not('.bg-danger').addClass(
                            'bg-light text-dark');
                    }
                });
            });

            function validateRoomSelection() {
                if (!$('#room_nos_id').val()) {
                    $('#room_error').show();
                    alert('Please select a room number!');
                    return false;
                }
                return true;
            }
        </script>
    @endsection
</div>
@endsection
