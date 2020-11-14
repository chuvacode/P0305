<?php

use Illuminate\Database\Seeder;

class AccessOther extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_others')->insert([
            'title' => encrypt('YouTube'),
            'link_sign_in' => encrypt('https://youtube.com'),
            'login' => encrypt('admin'),
            'password' => encrypt('qwertyu123'),
            'phone' => encrypt('79545444451'),
            'email' => encrypt('youtube@gmail.com'),
            'comment' => encrypt('0957493'),
        ]);

        DB::table('access_others')->insert([
            'title' => encrypt('RedConnect'),
            'link_sign_in' => encrypt('https://redhelper.ru/my/login?returnUrl=/redconnect'),
            'login' => encrypt('admin'),
            'password' => encrypt('qwertyu123'),
            'phone' => encrypt('79545444451'),
            'email' => encrypt('redconnect@mail.ru'),
            'comment' => encrypt('От popyti.ru'),
        ]);

        DB::table('access_others')->insert([
            'title' => encrypt('YouTube'),
            'link_sign_in' => encrypt('https://youtube.com'),
            'login' => encrypt('admin'),
            'password' => encrypt('qwertyu123'),
            'phone' => encrypt('821145444451'),
            'email' => encrypt('2youtube2@gmail.com'),
            'comment' => encrypt('0957493'),
        ]);
    }
}
