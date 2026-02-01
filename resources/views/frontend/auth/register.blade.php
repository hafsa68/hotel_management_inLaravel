@extends('frontend.layouts.master')

@section('content')
<main>
    <!-- Registration Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Create Account</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('user.register') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label>Full Name *</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="{{ old('name') }}" required autofocus>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input type="email" name="email" class="form-control" 
                                           value="{{ old('email') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Phone Number *</label>
                                    <input type="text" name="phone" class="form-control" 
                                           value="{{ old('phone') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirm Password *</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    Register
                                </button>
                                
                                <div class="text-center mt-3">
                                    <p>Already have an account? 
                                        <a href="{{ route('user.login') }}">Login here</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection