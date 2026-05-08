@extends('layouts.guest')

@section('content')

{{-- Info text --}}
<div class="mb-4 text-muted small">
    This is a secure area of the application. Please confirm your password before continuing.
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    {{-- Password --}}
    <div class="mb-3">
        <label class="form-label">
            <i class="bi bi-lock"></i> Password
        </label>

        <input type="password"
               name="password"
               id="password"
               class="form-control @error('password') is-invalid @enderror"
               required
               autocomplete="current-password"
               placeholder="Enter your password">

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Submit --}}
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            Confirm
        </button>
    </div>

</form>

@endsection