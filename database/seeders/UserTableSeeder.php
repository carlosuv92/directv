<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'CARLOS FELIPE';
        $user->surname = 'URCIA VEGA';
        $user->email = 'carlosuv92@gmail.com';
        $user->type_document = 'DNI';
        $user->document = '12345678';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
