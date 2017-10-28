<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'SUBSCRIBER',
        ]);
        DB::table('roles')->insert([
            'role' => 'EDITOR',
        ]);
        DB::table('roles')->insert([
            'role' => 'ADMIN',
        ]);
    }
}
