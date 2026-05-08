@extends('layouts.guest')

@section('content')

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    {{-- Token --}}
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    {{-- Email --}}
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-envelope"></i> Email
        </label>

        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $request->email) }}"
               required
               autofocus
               autocomplete="username"
               placeholder="Enter your email">

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- New Password --}}
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-lock"></i> New Password
        </label>

        <input type="password"
               name="password"
               id="password"
               class="form-control @error('password') is-invalid @enderror"
               required
               autocomplete="new-password"
               placeholder="Enter new password">

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-lock-fill"></i> Confirm Password
        </label>

        <input type="password"
               name="password_confirmation"
               class="form-control @error('password_confirmation') is-invalid @enderror"
               required
               autocomplete="new-password"
               placeholder="Confirm new password">

        @error('password_confirmation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            Reset Password
        </button>
    </div>

</form>

@endsection