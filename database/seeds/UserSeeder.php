<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Pre School Admin',
                'email' => 'preschooladmin@gmail.com',
                'password' => bcrypt('123123123'),
            ]
        ]);
    }
}
