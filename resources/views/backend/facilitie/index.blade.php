@extends("backend.layouts.app")
@section("head")

<head>
    <meta charset="utf-8" />
    <title>All Amenities | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

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
                                                    <th class="text-center" width="120">Status</th>
                                                    <th class="text-center" width="250">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($data as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
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
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('amenitie.edit', $item->id) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        
                                                        <!-- Status Toggle Button -->
                                                        <form action="{{ route('amenitie.toggle-status', $item->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Are you sure to change status?')">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm 
                                                                {{ $item->status == 'Enabled' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                                @if($item->status == 'Enabled')
                                                                <i class="fas fa-toggle-off me-1"></i> Disable
                                                                @else
                                                                <i class="fas fa-toggle-on me-1"></i> Enable
                                                                @endif
                                                            </button>
                                                        </form>
                                                        
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('amenitie.destroy', $item->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Are you sure to delete?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
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
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // Confirm before delete/toggle
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            
            if (button.classList.contains('btn-outline-danger')) {
                if (!confirm('Are you sure you want to delete this amenity?')) {
                    e.preventDefault();
                }
            } else if (button.textContent.includes('Disable') || button.textContent.includes('Enable')) {
                const action = button.textContent.includes('Disable') ? 'disable' : 'enable';
                if (!confirm('Are you sure you want to ' + action + ' this amenity?')) {
                    e.preventDefault();
                }
            }
        });
    });
});
</script>

@endsection