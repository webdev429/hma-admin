<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@hma.com',
            'role_id' => 1,
        ]);

        factory(App\User::class)->create([
            'id' => 2,
            'name' => 'Company User',
            'email' => 'creator@hma.com',
            'role_id' => 2,
        ]);

        factory(App\User::class)->create([
            'id' => 3,
            'name' => 'Non-Company user',
            'email' => 'member@hma.com',
            'role_id' => 3,
        ]);
    }
}
