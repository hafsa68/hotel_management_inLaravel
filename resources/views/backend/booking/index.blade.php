@extends("backend.layouts.app")

@section('head')
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 font-weight-bold text-primary">
                <i class="fa fa-list mr-2"></i> All Bookings
            </h4>
            <div>
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> New Booking
                </a>
                @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-times"></i> Clear Filters
                </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            {{-- Search and Filter Form --}}
            <div class="row mb-4">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('booking.index') }}" class="form-inline">
                        {{-- Search Box --}}
                        <div class="form-group mr-3 mb-2">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Search by name, email, phone or ID"
                                value="{{ request('search') }}">
                        </div>

                        {{-- Status Filter --}}
                        <div class="form-group mr-3 mb-2">
                            <select name="status" class="form-control form-control-sm">
                                <option value="">All Status</option>
                                <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        {{-- Date From --}}
                        <div class="form-group mr-3 mb-2">
                            <input type="date" name="date_from" class="form-control form-control-sm"
                                value="{{ request('date_from') }}" placeholder="From Date">
                        </div>

                        {{-- Date To --}}
                        <div class="form-group mr-3 mb-2">
                            <input type="date" name="date_to" class="form-control form-control-sm"
                                value="{{ request('date_to') }}" placeholder="To Date">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mb-2">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </form>
                </div>
            </div>

            {{-- Bookings Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#ID</th>
                            <th>Guest</th>
                            <th>Contact</th>
                            <th>Room</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Nights</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Booked On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- ✅ এখানে পরিবর্তন: $booking as $booking → $booking as $item --}}
                        @forelse($booking as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <strong>{{ $item->guest_name }}</strong>
                            </td>
                            <td>
                                @if($item->guest_email)
                                <div>{{ $item->guest_email }}</div>
                                @endif
                                @if($item->phone)
                                <div class="text-muted">{{ $item->phone }}</div>
                                @endif
                            </td>
                            <td>
                                <div><strong>{{ $item->room->room_number ?? 'N/A' }}</strong></div>
                                <small class="text-muted">{{ $item->roomType->name ?? 'N/A' }}</small>
                            </td>
                            <td>{{ date('d M, Y', strtotime($item->check_in)) }}</td>
                            <td>{{ date('d M, Y', strtotime($item->check_out)) }}</td>
                            <td class="text-center">{{ $item->nights }}</td>
                            <td class="text-right">৳{{ number_format($item->total_price, 2) }}</td>
                            <td>
    @php
        $statusConfig = [
            'booked' => ['bg-success', 'Booked'],
            'confirmed' => ['bg-primary', 'Confirmed'],
            'pending' => ['bg-warning text-dark', 'Pending'],
            'cancelled' => ['bg-danger', 'Cancelled'],
            'completed' => ['bg-info', 'Completed']
        ];
        
        $config = $statusConfig[$item->status] ?? ['bg-secondary', 'Unknown'];
        $class = $config[0];
        $text = $config[1];
    @endphp
    
    <span class="badge {{ $class }}" style="
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 500;
        font-size: 13px;
        opacity: 1;
        visibility: visible;
        display: inline-block;">
        {{ $text }}
    </span>
</td>
                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('booking.success', $item->id) }}"
                                        class="btn btn-info btn-sm" title="View Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick="editBooking({{ $item->id }})" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('booking.destroy', $item->id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this booking?')" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">
                                <i class="fa fa-info-circle fa-2x mb-2"></i><br>
                                No bookings found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $booking->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Edit Booking Modal (Optional) --}}
<div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Booking</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="editBookingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body" id="editBookingContent">
                    <!-- AJAX content will load here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{url('')}}/assets/js/vendor.min.js"></script>
<script src="{{url('')}}/assets/js/app.js"></script>
<script>
    function editBooking(id) {
        // AJAX request to get booking data
        $.ajax({
            url: '/booking/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editBookingContent').html(response);
                $('#editBookingForm').attr('action', '/booking/' + id);
                $('#editBookingModal').modal('show');
            },
            error: function() {
                alert('Error loading booking data');
            }
        });
    }
</script>
@endsection