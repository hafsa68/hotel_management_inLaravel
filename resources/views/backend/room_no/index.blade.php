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
                <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i> All Rooms</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fas fa-plus me-1"></i> Add New Room
                    </button>
                </div>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Rooms - {{ $roomType->name }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roomType->roomNumbers as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->room_number }}</td>
                                    <td>
                                        <span class="badge {{ $row->status == 'Enabled' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $row->status }}
                                        </span>
                                    </td>
                                    <td>
                                       <button class="btn btn-sm btn-info edit-btn" 
        data-id="{{ $row->id }}" 
        data-number="{{ $row->room_number }}" 
        data-status="{{ $row->status }}"
        data-bs-toggle="modal" 
        data-bs-target="#editRoomModal">
    Edit
</button>
<form action="{{ route('room_no.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this room?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">
        Delete
    </button>
</form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Rooms Found!</td>
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


<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">Add Room Number to {{ $roomType->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('room_no.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="room_id" value="{{ $roomType->id }}">

                    <div class="mb-3">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" name="room_number" id="room_number" class="form-control" placeholder="e.g. 101, 202" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text" name="room_number" id="edit_room_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-select">
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
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



    $(document).on('click', '.edit-btn', function() {
    let id = $(this).data('id');
    let number = $(this).data('number');
    let status = $(this).data('status');

   
    let url = "{{ route('room_no.update', ':id') }}";
    url = url.replace(':id', id);
    
    $('#editForm').attr('action', url);
    $('#edit_room_number').val(number);
    $('#edit_status').val(status); 
});
</script>


@endsection