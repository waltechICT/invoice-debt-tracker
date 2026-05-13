<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['host'] = request()->getHost();
        $data['subdomain'] = explode('.', request()->getHost())[0];

        $data['tenants'] = Auth::user()->tenants()->orderBy('created_at', 'desc')->paginate(4);

        // get tenants where subdomain matches the current request host
        $data['currentTenant'] = Tenant::where('subdomain', $data['subdomain'])->first();

        return view('tenant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:tenants,slug'],
            'subdomain' => ['nullable', 'string', 'max:255', 'unique:tenants,subdomain'],
            'metadata' => ['nullable', 'json'],
        ]);

        $tenant = Tenant::create([
            'owner_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'subdomain' => $validated['subdomain'] ?? null,
            'metadata' => isset($validated['metadata']) ? json_decode($validated['metadata'], true) : null,
            'is_active' => true,
        ]);

        $tenant->users()->attach(Auth::id(), ['role' => 'owner', 'is_active' => true]);

        return redirect()->route('tenant.index')->with('success', 'Tenant workspace created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        abort_unless(Auth::id() === $tenant->owner_id, 403);

        return view('tenant.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        abort_unless(Auth::id() === $tenant->owner_id, 403);

        return view('tenant.edit', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        abort_unless(Auth::id() === $tenant->owner_id, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:tenants,slug,'.$tenant->id],
            'subdomain' => ['nullable', 'string', 'max:255', 'unique:tenants,subdomain,'.$tenant->id],
            'metadata' => ['nullable', 'json'],
            'is_active' => ['required', 'boolean'],
        ]);

        $tenant->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'subdomain' => $validated['subdomain'] ?? null,
            'metadata' => isset($validated['metadata']) ? json_decode($validated['metadata'], true) : null,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('tenant.show', $tenant)->with('success', 'Tenant workspace updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        abort_unless(Auth::id() === $tenant->owner_id, 403);

        $tenant->delete();

        return redirect()->route('tenant.index')->with('success', 'Tenant workspace deleted successfully.');
    }
}
