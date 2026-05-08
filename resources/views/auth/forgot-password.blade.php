@extends('layouts.guest')

@section('content')

{{-- Info text --}}
<div class="mb-4 text-muted small">
    Forgot your password? No problem. Just enter your email address and we will send you a password reset link.
</div>

{{-- Session Status --}}
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    {{-- Email --}}
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-envelope"></i> Email
        </label>

        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}"
               placeholder="Enter your email address"
               required
               autofocus>

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            Email Password Reset Link
        </button>
    </div>

    {{-- Back to login --}}
    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Back to login</a>
    </div>

</form>

@endsection