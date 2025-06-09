<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        Permission::create([
            'group'=>'Role',
            "name"=>"role-delete"
        ]);
        Permission::create([
            'group'=>'Role',
            "name"=>"role-edit"
        ]);
        Permission::create([
            'group'=>'Role',
            "name"=>"role-create"
        ]);
        Permission::create([
            'group'=>'Role',
            "name"=>"role-list"
        ]);

        Permission::create([
            'group'=>'permission',
            "name"=>"permission-delete"
        ]);
        Permission::create([
            'group'=>'permission',
            "name"=>"permission-edit"
        ]);
        Permission::create([
            'group'=>'permission',
            "name"=>"permission-create"
        ]);
        Permission::create([
            'group'=>'permission',
            "name"=>"permission-list"
        ]);

        $role = Role::firstOrCreate([
            'name' => 'super-admin'
        ]);

        $role->givePermissionTo(Permission::all());

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
