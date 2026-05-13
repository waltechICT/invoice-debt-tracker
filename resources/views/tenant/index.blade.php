@extends('layouts.app')
{{-- page title --}}
@section('page_title', 'Tenant Management')
@section('content')

<div class="container-fluid py-2">
    <div class="mb-4">
        <h2 class="fs-4 fw-bold text-dark mb-1">My Tenants</h2>
        <p class="text-muted small mb-0">Manage and view all tenants in the system.</p>

         {{-- Create class button with plus icon--}}
        <a href="{{ route('tenant.create') }}" class="btn btn-sm btn-primary mt-2">
            <i class="bi bi-plus-lg"></i> Create New Tenant
        </a>       
    </div>

    <div class="card border border-light shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white p-4 border-bottom d-flex flex-wrap gap-2 justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0 fs-6">Tenant List</h5>
            <input type="text" id="tenantSearch" class="form-control form-control-sm w-auto" placeholder="Search tenants..." style="max-width: 300px;">
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="px-4 py-3">SN</th>
                        <th scope="col" class="px-4 py-3 sortable cursor-pointer" data-column="name" style="cursor: pointer;">
                            Name <i class="bi bi-arrow-down-up ms-1" style="font-size: 0.75rem;"></i>
                        </th>                     
                        <th scope="col" class="px-4 py-3 sortable cursor-pointer" data-column="subdomain" style="cursor: pointer;">
                            Subdomain <i class="bi bi-arrow-down-up ms-1" style="font-size: 0.75rem;"></i>
                        </th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $key=> $tenant)
                    <tr>
                        <th scope="row" class="px-4 py-3">{{ $key + 1 }}</th>
                        <td class="px-4 py-3">{{ $tenant->name }}</td>
                        <td class="px-4 py-3">{{ $tenant->subdomain }}</td>
                        <td class="px-4 py-3">
                            @if ($tenant->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('tenant.show', $tenant->id) }}" class="btn btn-sm btn-secondary me-1">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('tenant.edit', $tenant->id) }}" class="btn btn-sm btn-info me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('tenant.destroy', $tenant->id) }}" method="POST" class="d-inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentSortColumn = null;
    let sortAscending = true;

    // Search functionality
    const searchInput = document.getElementById('tenantSearch');
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('table tbody tr');

        tableRows.forEach(row => {
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const slug = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const subdomain = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            const matches = name.includes(searchTerm) || slug.includes(searchTerm) || subdomain.includes(searchTerm);
            row.style.display = matches ? '' : 'none';
        });
    });

    // Sorting functionality
    const sortHeaders = document.querySelectorAll('th.sortable');
    sortHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const column = this.getAttribute('data-column');
            const columnMap = { 'name': 2, 'slug': 3, 'subdomain': 4 };
            const columnIndex = columnMap[column];

            if (currentSortColumn === column) {
                sortAscending = !sortAscending;
            } else {
                currentSortColumn = column;
                sortAscending = true;
            }

            sortTable(columnIndex, sortAscending);
            updateSortIndicators();
        });
    });

    function sortTable(columnIndex, ascending) {
        const tbody = document.querySelector('table tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${columnIndex})`).textContent.trim();
            const bValue = b.querySelector(`td:nth-child(${columnIndex})`).textContent.trim();

            const comparison = aValue.localeCompare(bValue, undefined, { numeric: true });
            return ascending ? comparison : -comparison;
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    function updateSortIndicators() {
        const headers = document.querySelectorAll('th.sortable');
        headers.forEach(header => {
            const icon = header.querySelector('i');
            const column = header.getAttribute('data-column');
            
            if (column === currentSortColumn) {
                icon.className = sortAscending ? 'bi bi-sort-up ms-1' : 'bi bi-sort-down ms-1';
            } else {
                icon.className = 'bi bi-arrow-down-up ms-1';
            }
        });
    }
</script>
@endpush

@endsection