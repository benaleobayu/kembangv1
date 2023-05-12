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
            $permission = Permission::create(['name' => 'Access']);

            $permission = Permission::create(['name' => 'Read_Customers']);
            $permission = Permission::create(['name' => 'Create_Customers']);
            $permission = Permission::create(['name' => 'Edit_Customers']);
            $permission = Permission::create(['name' => 'Delete_Customers']);

            $permission = Permission::create(['name' => 'Read_Langganan']);
            $permission = Permission::create(['name' => 'Create_Langganan']);
            $permission = Permission::create(['name' => 'Edit_Langganan']);
            $permission = Permission::create(['name' => 'Delete_Langganan']);

            $permission = Permission::create(['name' => 'Read_DataRiders']);
            $permission = Permission::create(['name' => 'Create_DataRiders']);
            $permission = Permission::create(['name' => 'Edit_DataRiders']);
            $permission = Permission::create(['name' => 'Delete_DataRiders']);
            
            $permission = Permission::create(['name' => 'Read_DataOrders']);
            $permission = Permission::create(['name' => 'Create_DataOrders']);
            $permission = Permission::create(['name' => 'Edit_DataOrders']);
            $permission = Permission::create(['name' => 'Delete_DataOrders']);
            
            $permission = Permission::create(['name' => 'Read_PaymentRiders']);
            $permission = Permission::create(['name' => 'Create_PaymentRiders']);
            $permission = Permission::create(['name' => 'Edit_PaymentRiders']);
            $permission = Permission::create(['name' => 'Delete_PaymentRiders']);
            
            $permission = Permission::create(['name' => 'Read_Invoice']);
            $permission = Permission::create(['name' => 'Create_Invoice']);
            $permission = Permission::create(['name' => 'Edit_Invoice']);
            $permission = Permission::create(['name' => 'Delete_Invoice']);
            
            $permission = Permission::create(['name' => 'Read_Dokumentasi']);
            $permission = Permission::create(['name' => 'Create_Dokumentasi']);
            $permission = Permission::create(['name' => 'Edit_Dokumentasi']);
            $permission = Permission::create(['name' => 'Delete_Dokumentasi']);

            $permission = Permission::create(['name' => 'Read_Admin']);
            $permission = Permission::create(['name' => 'Create_Admin']);
            $permission = Permission::create(['name' => 'Edit_Admin']);
            $permission = Permission::create(['name' => 'Delete_Admin']);

            $permission = Permission::create(['name' => 'Read_Roles']);
            $permission = Permission::create(['name' => 'Create_Roles']);
            $permission = Permission::create(['name' => 'Edit_Roles']);
            $permission = Permission::create(['name' => 'Delete_Roles']);

            $permission = Permission::create(['name' => 'Read_Regency']);
            $permission = Permission::create(['name' => 'Create_Regency']);
            $permission = Permission::create(['name' => 'Edit_Regency']);
            $permission = Permission::create(['name' => 'Delete_Regency']);

            $permission = Permission::create(['name' => 'Read_Flower']);
            $permission = Permission::create(['name' => 'Create_Flower']);
            $permission = Permission::create(['name' => 'Edit_Flower']);
            $permission = Permission::create(['name' => 'Delete_Flower']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
