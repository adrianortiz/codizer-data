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
        // DB::table('users')->truncate();

        /*
        factory(App\User::class)->create([
        'name' => 'Adrian',
            'email' => 'adrian@codizer.com',
            'role' => 'admin',
            'password' => bcrypt('secret')
        ]);
        */

        // Usurio Adrian
        $id = \DB::table('users')->insertGetId([
            'name' => 'Adrian',
            'email' => 'adrian@codizer.com',
            'role' => 'admin',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        \DB::table('forms')->insert([
            'name' => 'Alumnos',
            'description' => 'Informacion de los alumnos de 8ITI1',
            'user_id' => $id,
            'remember_token' => str_random(10)
        ]);


        // Usurio Alex
        $id = \DB::table('users')->insertGetId([
            'name' => 'Alex',
            'email' => 'alex@codizer.com',
            'role' => 'user',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        \DB::table('forms')->insert([
            'name' => 'Laboratorios',
            'description' => 'Información sobre calidad en las medidas de un laboratorio',
            'user_id' => $id,
            'remember_token' => str_random(10)
        ]);

        factory(App\User::class, 48)->create();

    }
}
