<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::beginTransaction();

        try {
            $permission = Permission::create(['name' => 'Read Customers']);
            $permission = Permission::create(['name' => 'Create Customers']);
            $permission = Permission::create(['name' => 'Edit Customers']);
            $permission = Permission::create(['name' => 'Delete Customers']);

            $permission = Permission::create(['name' => 'Read Langganan']);
            $permission = Permission::create(['name' => 'Create Langganan']);
            $permission = Permission::create(['name' => 'Edit Langganan']);
            $permission = Permission::create(['name' => 'Delete Langganan']);

            $permission = Permission::create(['name' => 'Read DataRiders']);
            $permission = Permission::create(['name' => 'Create DataRiders']);
            $permission = Permission::create(['name' => 'Edit DataRiders']);
            $permission = Permission::create(['name' => 'Delete DataRiders']);

            $permission = Permission::create(['name' => 'Read Admin']);
            $permission = Permission::create(['name' => 'Create Admin']);
            $permission = Permission::create(['name' => 'Edit Admin']);
            $permission = Permission::create(['name' => 'Delete Admin']);


            $permission = Permission::create(['name' => 'Read Roles']);
            $permission = Permission::create(['name' => 'Create Roles']);
            $permission = Permission::create(['name' => 'Edit Roles']);
            $permission = Permission::create(['name' => 'Delete Roles']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
