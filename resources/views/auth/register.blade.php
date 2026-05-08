@extends('layouts.guest')
@section('content')
    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-person"></i> Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Enter you full name" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email with place holder --}}
        <div class="mb-3">
            <label class="form-label">
                <i class="bi bi-envelope"></i> Email
            </label>

            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Enter your email address" required>

            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        

        {{-- Password --}}
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-lock"></i> Password</label>

            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>

            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-lock"></i> Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Confirm your password" required>
            @error('password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

              

        {{-- show password --}}
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
            <label class="form-check-label" for="showPassword">Show Password</label>
        </div>


        {{-- Phone --}}
        {{-- <div class="mb-3">
            <label class="form-label"><i class="bi bi-telephone"></i> Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                placeholder="Enter your phone number">
            @error('phone')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div> --}}

        {{-- add a border line or separator--}}
        <hr class="my-4">

        {{-- Address --}}
        {{-- <div class="mb-3">
            <label class="form-label"><i class="bi bi-geo-alt"></i> Address</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                placeholder="Enter your address">
            @error('address')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div> --}}
        
        {{-- Submit --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>

        {{-- Login link --}}
        <div class="mt-3 text-center">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>

        {{-- Password and confirm password toggle script --}}
        @push('scripts')
            <script>
                function togglePassword() {
                    const passwordField = document.getElementById('password');
                    const confirmPasswordField = document.getElementById('password_confirmation');
                    const type = passwordField.type === 'password' ? 'text' : 'password';
                    passwordField.type = type;
                    confirmPasswordField.type = type;
                }
            </script>
        @endpush



    </form>
@endsection