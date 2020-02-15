<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $data = [

            [
                'name' => 'Avtor tapilmadi',
                'email' => 'unknown@g.g',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Avtor',
                'email' => 'author1@g.g',
                'password' => bcrypt('12345678'),
            ]
        ];
            DB::table('users')->insert($data);
    }
}
