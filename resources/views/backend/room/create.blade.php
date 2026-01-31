@extends("backend.layouts.app")

@section("head")
<head>
    <meta charset="utf-8" />
    <title>Add Room | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">
    <link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>
    </head>
@endsection

@section("content")
<div class="container-fluid">
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add New Room</h4>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="post" action="{{route('room.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Room Name" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Slug *</label>
                                    <input type="text" name="slug" class="form-control" placeholder="room-slug" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Room / Suite *</label>
                                    <select class="form-select" name="room_type" required>
                                        <option value="">Select One</option>
                                        <option value="Room">Room</option>
                                        <option value="Suite">Suite</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Fare / Night *</label>
                                    <div class="input-group">
                                        <input type="number" name="fare" class="form-control" required>
                                        <span class="input-group-text">USD</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Offer Fare / Night</label>
                                    <div class="input-group">
                                        <input type="number" name="offer_fare" class="form-control">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Cancellation Fee / Night *</label>
                                    <div class="input-group">
                                        <input type="number" name="cancellation_fee" class="form-control">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Total Adult *</label>
                                    <input type="number" name="total_adult" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Total Child *</label>
                                    <input type="number" name="total_child" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Size *</label>
                                    <input type="text" name="size" class="form-control" placeholder="e.g. 250 sqft">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Amenities</label>
                                    <input type="text" name="amenities" class="form-control" placeholder="WiFi, AC, TV">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Facilities</label>
                                    <input type="text" name="facilities" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Keywords</label>
                                    <input type="text" name="keywords" class="form-control" placeholder="Keywords separated by comma">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Featured</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="is_featured" id="featured1" value="1">
                                        <label class="btn btn-outline-danger" for="featured1">Featured</label>
                                        <input type="radio" class="btn-check" name="is_featured" id="featured0" value="0" checked>
                                        <label class="btn btn-outline-secondary" for="featured0">Unfeatured</label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Main Image (1000x500)</label>
                                    <div class="border d-flex align-items-center justify-content-center bg-light" style="height: 200px; border-style: dashed !important;">
                                        <input type="file" name="main_image" class="form-control w-75">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="8"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Gallery Images</label>
                                    <div class="border p-4 text-center bg-light" style="border-style: dashed !important;">
                                        <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i>
                                        <p>Drag & Drop files here or click to browse</p>
                                        <input type="file" name="gallery[]" multiple class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cancellation Policy</label>
                                <textarea name="cancellation_policy" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary shadow-sm">
                                    <i class="fas fa-save me-1"></i> Save Room Information
                                </button>
                                <a href="{{ route('room.index') }}" class="btn btn-secondary shadow-sm">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
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
@endsection