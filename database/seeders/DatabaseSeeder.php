<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Promo;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
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

            $roles = [  "admin", "teacher", "student"];
            foreach ($roles as $role) {
                Role::create(['name' => $role]);
            }

            $users = User::factory(10)->create();
            foreach ($users as $user) {
                $user->assignRole("student");
            }

            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin')
            ])->assignRole("admin");
            User::create([
                'name' => 'teacher',
                'email' => 'teacher@teacher.com',
                'password' => Hash::make('teacher')
            ])->assignRole("teacher");


            for ($i = 2010; $i < 2030; $i++) {
                Promo::create([
                    "year" => $i . "/" . ($i + 1)
                ]);
            }
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
