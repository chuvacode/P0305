<?php

use Illuminate\Database\Seeder;

class Client extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'title' => 'прораб-ростов.рф'
        ]);

        DB::table('clients')->insert([
            'title' => 'родная-клиника.рф'
        ]);

        DB::table('clients')->insert([
            'title' => 'delfinary-rostov.ru'
        ]);
    }
}
