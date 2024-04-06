<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Promo;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {

            $roles = ["admin", "teacher", "student"];
            foreach ($roles as $role) {
                Role::create(['name' => $role]);
            }
            for ($i = 2010; $i < 2030; $i++) {
                Promo::create([
                    "year" => $i . "/" . ($i + 1)
                ]);
            }
            
            
            User::create([
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'firstName' => 'AdminFirstName',
                'lastName' => 'AdminLastName',
                'grade_id' => 1,
                'address' => 'Admin Address',
                'number_phone' => '1234567890',
                'date_d_inscription' => now(),
                'role_id' => 1
            ]);

            User::create([
                'username' => 'teacher',
                'email' => 'teacher@teacher.com',
                'password' => Hash::make('password'),
                'firstName' => 'teacherFirstName',
                'lastName' => 'teacherLastName',
                'grade_id' => 1,
                'address' => 'teacher Address',
                'number_phone' => '1234567890',
                'date_d_inscription' => now(),
                'role_id' => 2
            ]);
            
            $users = User::factory(30)->create();


            // User::create([
            //     'name' => 'teacher',
            //     'email' => 'teacher@teacher.com',
            //     'password' => Hash::make('teacher')
            // ])->assignRole("teacher");



            $faker = Faker::create();
            Grade::create([
                "name" => $faker->sentence(2)
            ]);

            Grade::create([
                "name" => $faker->sentence(2)
            ]);

            Grade::create([
                "name" => $faker->sentence(2)
            ]);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
