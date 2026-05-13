@extends('layouts.app')
{{-- page title --}}
@section('page_title', 'New Tenant')
@section('content')

<div class="container-fluid py-2">
    <div class="mb-4">
        <h2 class="fs-4 fw-bold text-dark mb-1">{{ 'Create New Tenant' }}</h2>
        <p class="text-muted small mb-0">Create a new tenant workspace.</p>
    </div>

    <div class="card border border-light shadow-sm rounded-4 overflow-hidden">
        <form action="{{ route('tenant.store') }}" method="POST">
            @csrf
            <div class="card-body p-3 p-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Tenant Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter tenant name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Tenant Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug') }}" placeholder="Enter tenant slug" required>
                    @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subdomain" class="form-label">Subdomain</label>
                    <input type="text" name="subdomain" id="subdomain" class="form-control @error('subdomain') is-invalid @enderror"
                        value="{{ old('subdomain') }}" placeholder="Enter tenant subdomain (optional)">
                    @error('subdomain')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="metadata" class="form-label">Metadata</label>
                    <textarea name="metadata" id="metadata" rows="3"
                        class="form-control @error('metadata') is-invalid @enderror"
                        placeholder="{&quot;color&quot;:&quot;blue&quot;,&quot;timezone&quot;:&quot;UTC&quot;}">{{ old('metadata') }}</textarea>
                    @error('metadata')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Optional JSON metadata for the tenant workspace.</div>
                </div>

                <div class="d-grid d-md-block mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i> Create Tenant
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection