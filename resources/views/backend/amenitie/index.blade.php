@extends("backend.layouts.app")
@section("head")

<head>
    <meta charset="utf-8" />
    <title>All Amenities | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>

</head>
@endsection
@section("content")

<div class="container-fluid">


    <!-- start page title -->
    <div class="page-content">


        <!-- ========== Topbar End ========== -->

        <div class="px-3">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
                <!-- end page title -->


                <!--- end row -->


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-list me-2"></i> All Amenities
                                    </h5>
                                    <a href="{{ route('amenitie.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i> Add New
                                    </a>
                                </div>

                                <div class="card-body p-0">
                                    @if($data->isEmpty())
                                    <div class="text-center py-5">
                                        <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                        <p class="text-muted">No amenities found.</p>
                                        <a href="{{ route('amenitie.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add First Amenity
                                        </a>
                                    </div>
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle mb-0">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th width="50">SL</th>
                                                    <th>Icon</th>
                                                    <th>Title</th>
                                                    <th class="text-center" width="90">Status</th>
                                                    <th class="text-center" width="300">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($data as $item)
                                                <tr>
                                                    <td>{{$item->id }}</td>
                                                    <td>
                                                        @if($item->icon)
                                                        <i class="fas {{ $item->icon }} fa-lg text-primary"></i>
                                                        @else
                                                        <i class="fas fa-question-circle fa-lg text-secondary"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td class="text-center">
                                                        @if($item->status == 'Enabled')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle me-1"></i> Enabled
                                                        </span>
                                                        @else
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times-circle me-1"></i> Disabled
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="{{ route('amenitie.edit', $item->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>


                                                        <button
                                                            type="button"
                                                            class="btn btn-sm toggle-status 
                                                                {{ $item->status == 'Enabled' ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                            data-id="{{ $item->id }}"
                                                            data-status="{{ $item->status }}">
                                                            @if($item->status == 'Enabled')
                                                            <i class="fas fa-toggle-off me-1"></i> Disable
                                                            @else
                                                            <i class="fas fa-toggle-on me-1"></i> Enable
                                                            @endif
                                                        </button>

                                                        <!-- <button type="submit" class="btn btn-sm 
                                                                {{ $item->status == 'Enabled' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                            @if($item->status == 'Enabled')
                                                            <i class="fas fa-toggle-off me-1"></i> Disable
                                                            @else
                                                            <i class="fas fa-toggle-on me-1"></i> Enable
                                                            @endif
                                                        </button> -->




                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!--end row-->

</div>

@endsection

@section("scripts")
<script src="{{url('')}}/assets/js/vendor.min.js"></script>
<script src="{{url('')}}/assets/js/app.js"></script>
<script>
    $(document).on('click', '.toggle-status', function() {

        let button = $(this);
        let id = button.data('id');

        $.ajax({
            url: "{{ route('amenitie.status.toggle') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            },
            success: function(response) {

                if (response.status === 'Enabled') {
                    button
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-warning')
                        .html('<i class="fas fa-toggle-off me-1"></i> Disable');

                    button.closest('tr').find('.badge')
                        .removeClass('bg-danger')
                        .addClass('bg-success')
                        .html('<i class="fas fa-check-circle me-1"></i> Enabled');

                } else {
                    button
                        .removeClass('btn-outline-warning')
                        .addClass('btn-outline-success')
                        .html('<i class="fas fa-toggle-on me-1"></i> Enable');

                    button.closest('tr').find('.badge')
                        .removeClass('bg-success')
                        .addClass('bg-danger')
                        .html('<i class="fas fa-times-circle me-1"></i> Disabled');
                }
            }
        });
    });
</script>



@endsection