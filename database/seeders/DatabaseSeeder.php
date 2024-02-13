<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();
        
        try {
            $roles = ["super admin", "admin" , "prof" , "student" ];
            foreach ($roles as $role) {
                Role::create(['name' => $role]);
            }
            
            $users = User::factory(10)->create();
            foreach ($users as $user) {
                $user->assignRole("student");
            }
            
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' =>  Hash::make('admin')
            ])->assignRole("super admin");
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
