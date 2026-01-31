@extends("backend.layouts.app")

@section("head")

<head>
    <meta charset="utf-8" />
    <title>All Rooms | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">
    <link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>
    <style>
        .table thead th {
            background-color: #f8f9fa;
            text-transform: capitalize;
            font-weight: 600;
        }

        .room-name {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
@endsection

@section("content")
<div class="container-fluid">
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i> All Rooms</h5>
                        <a href="{{ route('room.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add New Room
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Name</th>
                                        <th>Fare</th>
                                        <th>Adult</th>
                                        <th>Child</th>
                                        <th>Feature Status</th>
                                        <th>Room / Suite</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="room-name">{{ $item->name }}</td>
                                        <td>${{ number_format($item->fare, 2) }}</td>
                                        <td>{{ $item->total_adult ?? $item->adults }}</td>
                                        <td>{{ $item->total_child ?? $item->children }}</td>
                                        <td>
                                            @if($item->is_featured == 'Featured')
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Featured</span>
                                            @else
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Unfeatured</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->room_type }}</td>
                                        <td>
                                            <span class="status-badge badge {{ $item->status == 'Enabled' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group gap-1">

                                             <a href="{{ route('room_no.index', $item->id) }}" class="btn btn-outline-primary" style="border-radius: 20px;">
                                                + Rooms ({{ $item->roomNumbers->count() }})
                                            </a>
                                                <a href="{{ route('room.edit', $item->id) }}" class="btn btn-sm btn-soft-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm toggle-status {{ $item->status == 'Enabled' ? 'btn-soft-warning' : 'btn-soft-success' }}"
                                                    data-id="{{ $item->id }}" title="Toggle Status">
                                                    <i class="fas {{ $item->status == 'Enabled' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                </button>
                                                    
                                           
                                        
                                                <form action="{{ route('room.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this room?')" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn- btn-soft-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">No rooms found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script src="{{url('')}}/assets/js/vendor.min.js"></script>
<script src="{{url('')}}/assets/js/app.js"></script>
<script>
    $(document).on('click', '.toggle-status', function() {
        let button = $(this);
        let id = button.data('id');
        let row = button.closest('tr');

        $.ajax({
            url: "{{ route('room.status.toggle') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            },
            success: function(response) {
                if (response.status === 'Enabled') {
                    button.removeClass('btn-soft-success').addClass('btn-soft-warning')
                        .html('<i class="fas fa-eye-slash"></i>');
                    row.find('.status-badge').removeClass('bg-danger').addClass('bg-success').text('Enabled');
                } else {
                    button.removeClass('btn-soft-warning').addClass('btn-soft-success')
                        .html('<i class="fas fa-eye"></i>');
                    row.find('.status-badge').removeClass('bg-success').addClass('bg-danger').text('Disabled');
                }
            }
        });
    });
</script>
@endsection