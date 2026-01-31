@extends("backend.layouts.app")
@section("head")

<head>
    <meta charset="utf-8" />
    <title>Edit Amenity | Admin Panel</title>
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
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">
                        <i class="fas fa-edit me-2"></i> Edit Amenity
                    </h4>
                </div>
                <div class="col-lg-6 text-end">
                    <a href="{{ route('amenitie.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="post" action="{{ route('amenitie.update', $amenitie->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" 
                                       name="title" 
                                       class="form-control" 
                                       value="{{ old('title', $amenitie->title) }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Enabled" {{ $amenitie->status == 'Enabled' ? 'selected' : '' }}>Enabled</option>
                                    <option value="Disabled" {{ $amenitie->status == 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class (FontAwesome)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="icon" 
                                       name="icon" 
                                       value="{{ old('icon', $amenitie->icon) }}"
                                       placeholder="fa-wifi, fa-tv, etc.">
                                <small class="text-muted">Example: fa-wifi, fa-tv, fa-snowflake</small>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Amenity
                                </button>
                                <a href="{{ route('amenitie.index') }}" class="btn btn-secondary">
                                    Cancel
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