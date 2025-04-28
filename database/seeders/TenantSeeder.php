<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for multi-tenancy
        $t1=Tenant::create([
            'id' => 'Tenant1',
            'name' => 'Tenant 1',
            'address' => 'Address1',
            'phone' => '123456789',]);

        $t1->domains()->create(['domain' => 'tenant1.'. parse_url(config('app.url'), PHP_URL_HOST)]);

        $t2=Tenant::create([
            'id' => 'Tenant2',
            'name' => 'Tenant 2',
            'address' => 'Address2',
            'phone' => '123456789',]);
        $t2->domains()->create(['domain' => 'tenant2.' . parse_url(config('app.url'), PHP_URL_HOST)]);

        $t3=Tenant::create([
            'id' => 'Tenant3',
            'name' => 'Tenant 3',
            'address' => 'Address3',
            'phone' => '123456789',]);
        $t3->domains()->create(['domain' => 'tenant3.' . parse_url(config('app.url'), PHP_URL_HOST)]);

    }
}
