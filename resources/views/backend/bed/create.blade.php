@extends("backend.layouts.app")
@section("head")

<head>
    <meta charset="utf-8" />
    <title>Form Elements | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
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
                <div class="col-lg-8">
                    <h4 class="page-title mb-0">Amenitie Entry Form</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form method="post" action="{{route('bed.store')}}">
                          
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Bed Type *</label>
                                <input type="text" 
                                       name="bed_type" 
                                       id="title"
                                       class="form-control @error('bed_type') is-invalid @enderror"
                                       value="{{ old('bed_type') }}"
                                       placeholder="Enter amenity title"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status"
                                        required>
                                    <option value="">Select Status</option> 
                                    <option value="Enabled" 
                                        {{ old('status', 'Enabled') == 'Enabled' ? 'selected' : '' }}>
                                        Enabled
                                    </option>
                                    <option value="Disabled" 
                                        {{ old('status') == 'Disabled' ? 'selected' : '' }}>
                                        Disabled
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class (FontAwesome)</label>
                                <input type="text" 
                                       class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" 
                                       name="icon" 
                                       value="{{ old('icon') }}"
                                       placeholder="fa-wifi, fa-tv, etc.">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Examples: fa-wifi, fa-tv, fa-snowflake, fa-swimming-pool
                                </small>
                            </div>

                            

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Add Bed Type
                            </button>
                            <a href="{{ route('bed.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i> Back to List
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick icon selection
    document.querySelectorAll('.icon-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.getAttribute('data-icon');
            document.getElementById('icon').value = icon;
            
            // Highlight selected button
            document.querySelectorAll('.icon-btn').forEach(b => {
                b.classList.remove('btn-primary');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-primary');
        });
    });
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const status = document.getElementById('status').value;
        
        if (!title) {
            e.preventDefault();
            alert('Please enter a title');
            document.getElementById('title').focus();
            return false;
        }
        
        if (!status) {
            e.preventDefault();
            alert('Please select a status');
            document.getElementById('status').focus();
            return false;
        }
    });
    
    // Auto-select Enabled by default
    const statusSelect = document.getElementById('status');
    if (!statusSelect.value) {
        statusSelect.value = 'Enabled';
    }
});
</script>

<style>
.icon-btn:hover {
    transform: translateY(-2px);
    transition: all 0.2s;
}
.btn-outline-secondary.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}
</style>

@endsection

@section("scripts")
<script src="{{url('')}}/assets/js/vendor.min.js"></script>
<script src="{{url('')}}/assets/js/app.js"></script>
@endsection