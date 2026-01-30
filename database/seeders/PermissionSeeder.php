<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsData = [
            [
                'name' => 'View Role',
                'guard_name' => 'web',
                'slug' => 'view-role',
                'module_name' => 'Role',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Role',
                'guard_name' => 'web',
                'slug' => 'add-role',
                'module_name' => 'Role',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Role',
                'guard_name' => 'web',
                'slug' => 'edit-role',
                'module_name' => 'Role',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Role',
                'guard_name' => 'web',
                'slug' => 'delete-role',
                'module_name' => 'Role',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'View Dashboard',
                'guard_name' => 'web',
                'slug' => 'view-dashboard',
                'module_name' => 'Dashboard',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Dashboard',
                'guard_name' => 'web',
                'slug' => 'add-dashboard',
                'module_name' => 'Dashboard',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Dashboard',
                'guard_name' => 'web',
                'slug' => 'edit-dashboard',
                'module_name' => 'Dashboard',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Dashboard',
                'guard_name' => 'web',
                'slug' => 'delete-dashboard',
                'module_name' => 'Dashboard',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'View User',
                'guard_name' => 'web',
                'slug' => 'view-user',
                'module_name' => 'User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add User',
                'guard_name' => 'web',
                'slug' => 'add-user',
                'module_name' => 'User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit User',
                'guard_name' => 'web',
                'slug' => 'edit-user',
                'module_name' => 'User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete User',
                'guard_name' => 'web',
                'slug' => 'delete-user',
                'module_name' => 'User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // Admin User
            [
                'name' => 'View Admin User',
                'guard_name' => 'web',
                'slug' => 'view-admin-user',
                'module_name' => 'Admin User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Admin User',
                'guard_name' => 'web',
                'slug' => 'add-admin-user',
                'module_name' => 'Admin User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Admin User',
                'guard_name' => 'web',
                'slug' => 'edit-admin-user',
                'module_name' => 'Admin User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Admin User',
                'guard_name' => 'web',
                'slug' => 'delete-admin-user',
                'module_name' => 'Admin User',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // Category
            [
                'name' => 'View Category',
                'guard_name' => 'web',
                'slug' => 'view-category',
                'module_name' => 'Category',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Category',
                'guard_name' => 'web',
                'slug' => 'add-category',
                'module_name' => 'Category',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Category',
                'guard_name' => 'web',
                'slug' => 'edit-category',
                'module_name' => 'Category',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Category',
                'guard_name' => 'web',
                'slug' => 'delete-category',
                'module_name' => 'Category',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // Tags
            [
                'name' => 'View Tag',
                'guard_name' => 'web',
                'slug' => 'view-tag',
                'module_name' => 'Tag',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Tag',
                'guard_name' => 'web',
                'slug' => 'add-tag',
                'module_name' => 'Tag',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Tag',
                'guard_name' => 'web',
                'slug' => 'edit-tag',
                'module_name' => 'Tag',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Tag',
                'guard_name' => 'web',
                'slug' => 'delete-tag',
                'module_name' => 'Tag',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // State
            [
                'name' => 'View State',
                'guard_name' => 'web',
                'slug' => 'view-state',
                'module_name' => 'State',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add State',
                'guard_name' => 'web',
                'slug' => 'add-state',
                'module_name' => 'State',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit State',
                'guard_name' => 'web',
                'slug' => 'edit-state',
                'module_name' => 'State',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete State',
                'guard_name' => 'web',
                'slug' => 'delete-state',
                'module_name' => 'State',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // District
            [
                'name' => 'View District',
                'guard_name' => 'web',
                'slug' => 'view-district',
                'module_name' => 'District',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add District',
                'guard_name' => 'web',
                'slug' => 'add-district',
                'module_name' => 'District',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit District',
                'guard_name' => 'web',
                'slug' => 'edit-district',
                'module_name' => 'District',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete District',
                'guard_name' => 'web',
                'slug' => 'delete-district',
                'module_name' => 'District',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // City
            [
                'name' => 'View City',
                'guard_name' => 'web',
                'slug' => 'view-city',
                'module_name' => 'City',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add City',
                'guard_name' => 'web',
                'slug' => 'add-city',
                'module_name' => 'City',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit City',
                'guard_name' => 'web',
                'slug' => 'edit-city',
                'module_name' => 'City',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete City',
                'guard_name' => 'web',
                'slug' => 'delete-city',
                'module_name' => 'City',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            // Vendor
            [
                'name' => 'View Vendor',
                'guard_name' => 'web',
                'slug' => 'view-vendor',
                'module_name' => 'Vendor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Add Vendor',
                'guard_name' => 'web',
                'slug' => 'add-vendor',
                'module_name' => 'Vendor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Edit Vendor',
                'guard_name' => 'web',
                'slug' => 'edit-vendor',
                'module_name' => 'Vendor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Delete Vendor',
                'guard_name' => 'web',
                'slug' => 'delete-vendor',
                'module_name' => 'Vendor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ];

        foreach($permissionsData as $key => $value)
        {
            $isPermissionExists = Permission::where('name', $value['name'])->exists();

            if(!$isPermissionExists)
            {
                Permission::create($value);
            }
        }
    }
}
