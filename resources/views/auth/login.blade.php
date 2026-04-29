@extends('layouts.base')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
            <div class="form-section">
                <h2 class="text-center mb-4" style="color: var(--primary-color);">
                    <i class="bi bi-box2-heart"></i> Inventory Management
                </h2>
                <h5 class="text-center mb-4">Login to Your Account</h5>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <hr class="my-4">
                <p class="text-center mb-0" style="font-size:0.9rem; color:#7f8c8d;">
                    Don't have an account?
                    <a href="{{ route('register') }}" style="color:#3498db; font-weight:500; text-decoration:none;">
                        <i class="bi bi-person-plus"></i> Create Account
                    </a>
                </p>

                @if(app()->isLocal())
                <div class="mt-4 p-3 bg-light rounded border">
                    <p class="mb-1 text-muted small"><i class="bi bi-info-circle"></i> <strong>Dev Credentials:</strong></p>
                    <p class="mb-1 small"><strong>Admin:</strong> admin@inventory.com / admin123</p>
                    <p class="mb-0 small"><strong>Staff:</strong> staff@inventory.com / staff123</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
