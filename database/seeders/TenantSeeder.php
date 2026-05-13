<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'Acme Corporation',
                'slug' => 'acme-corp',
                'subdomain' => 'acme',
                'metadata' => ['timezone' => 'UTC', 'currency' => 'USD'],
                'is_active' => true,
            ],
            [
                'name' => 'Blue Horizon',
                'slug' => 'blue-horizon',
                'subdomain' => 'blue',
                'metadata' => ['timezone' => 'UTC', 'currency' => 'EUR'],
                'is_active' => true,
            ],
            [
                'name' => 'Green Fields',
                'slug' => 'green-fields',
                'subdomain' => 'green',
                'metadata' => ['timezone' => 'UTC', 'currency' => 'GBP'],
                'is_active' => true,
            ],
            [
                'name' => 'Silver Line',
                'slug' => 'silver-line',
                'subdomain' => 'silver',
                'metadata' => ['timezone' => 'UTC', 'currency' => 'CAD'],
                'is_active' => true,
            ],
        ];

        $owner = User::first();

        foreach ($tenants as $tenant) {
            $tenant['owner_id'] = $owner?->id;
            $created = Tenant::updateOrCreate(
                ['slug' => $tenant['slug']],
                $tenant
            );

            if ($owner) {
                $created->users()->syncWithoutDetaching($owner->id);
            }
        }
    }
}
