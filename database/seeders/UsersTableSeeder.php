<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $editor = User::create([

            'name' => 'editar',
            'email'=> 'editar@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $editor->assignRole('editor');


        /// modelador

         $editor = User::create([

            'name' => 'moderador',
            'email'=> 'moderador@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $editor->assignRole('moderador');


        // admimn super

         $editor = User::create([

            'name' => 'admin',
            'email'=> 'admmin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $editor->assignRole('super-admin');
    }
}
