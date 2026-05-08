@extends('layouts.guest')

@section('content')

{{-- Info text --}}
<div class="mb-4 text-muted small">
    Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.
    If you didn’t receive it, we can send you another.
</div>

{{-- Status message --}}
@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success">
        A new verification link has been sent to your email address.
    </div>
@endif

{{-- Actions --}}
<div class="d-flex justify-content-between align-items-center">

    {{-- Resend verification email --}}
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="btn btn-primary">
            Resend Email
        </button>
    </form>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="btn btn-link text-decoration-underline">
            Logout
        </button>
    </form>

</div>

@endsection