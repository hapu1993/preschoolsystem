<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->delete();
        DB::table('levels')->insert([
         [
            'id' => 1,
            'name' => 'UPPER',
        ],[
            'id' => 2,
            'name' => 'DOWN',
        ]
        ]);
    }
}
