<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Чуваков Алексей',
            'email' => 'aleksey.chuv@yandex.ru',
            'password' => Hash::make('admin'),
            'privilege' => 'administrator',
            'avatar_url' => '/images/avatar.png'
        ]);

        DB::table('users')->insert([
            'name' => 'Иван Иванов',
            'email' => 'ivan@yandex.ru',
            'password' => Hash::make('user'),
            'privilege' => 'worker'
        ]);
    }
}
