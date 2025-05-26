<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create('en_US');

        $role = Role::firstOrCreate([
            'name' => 'super-admin'
        ]);

        $user = User::create([
            'name' => "Mepego",
            'email' => "mepego@gmail.com",
            'password' => Hash::make("Mepego@123#"),
            'phone' => $faker->phoneNumber,
            'date_of_birth' => $faker->date(),
            'address' => $faker->address,
            'street_address' => $faker->streetAddress,
            'apt_suite' => $faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip_code' => $faker->postcode,
            'country' => $faker->country,
        ]);

        $user->assignRole($role);
    }
}
