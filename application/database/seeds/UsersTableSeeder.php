<?php

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
        DB::table('users')->insert([
            // 'id' => 1,
            'username' => 'tjay',
            'name' => 'Tunji Oyeniran',
            'password' => bcrypt('kooler'),
            'email' => 'oyenirantunji2339@gmail.com',
            'telephone' => '08189695902',
            'gender' => 'MALE',
            // 'avatar' => 'imgs/user.png',
            'role_id' => 3,
            // 'created_by' => NULL
        ]);
    }
}