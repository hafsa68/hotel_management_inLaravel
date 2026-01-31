@extends("backend.layouts.app")

@section("head")
<head>
    <meta charset="utf-8" />
    <title>Edit Room | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>
    <style>
        .preview-img { width: 150px; height: 100px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; border: 2px solid #ddd; }
    </style>
</head>
@endsection

@section("content")
<div class="container-fluid">
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Edit Room: {{ $room->name }}</h4>

                        <form method="post" action="{{ route('room.update', $room->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $room->name) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $room->slug) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Room / Suite *</label>
                                    <select class="form-select" name="room_type" required>
                                        <option value="Room" {{ $room->room_type == 'Room' ? 'selected' : '' }}>Room</option>
                                        <option value="Suite" {{ $room->room_type == 'Suite' ? 'selected' : '' }}>Suite</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Fare / Night *</label>
                                    <input type="number" name="fare" class="form-control" value="{{ old('fare', $room->fare) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Adults *</label>
                                    <input type="number" name="adults" class="form-control" value="{{ old('adults', $room->adults) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Children *</label>
                                    <input type="number" name="children" class="form-control" value="{{ old('children', $room->children) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="Enabled" {{ $room->status == 'Enabled' ? 'selected' : '' }}>Enabled</option>
                                        <option value="Disabled" {{ $room->status == 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Feature Status</label>
                                    <select class="form-select" name="is_featured">
                                        <option value="Featured" {{ $room->is_featured == 'Featured' ? 'selected' : '' }}>Featured</option>
                                        <option value="Unfeatured" {{ $room->is_featured == 'Unfeatured' ? 'selected' : '' }}>Unfeatured</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Change Main Image</label>
                                    <div class="mb-2">
                                        @if($room->main_image)
                                            <p class="small text-muted">Current Image:</p>
                                            <img src="{{ asset($room->main_image) }}" class="preview-img">
                                        @endif
                                    </div>
                                    <input type="file" name="main_image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5">{{ old('description', $room->description) }}</textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update Room
                                </button>
                                <a href="{{ route('room.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Back
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