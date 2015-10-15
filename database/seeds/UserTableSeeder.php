<?php

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
        // Truncar la tabla de usuarios
        DB::table('users')->truncate();

        factory(App\User::class)->create([
            'name' => 'Adrian',
            'email' => 'adrian@codizer.com',
            'role' => 'admin',
            'password' => bcrypt('secret')
        ]);

        factory(App\User::class, 49)->create();

    }
}
