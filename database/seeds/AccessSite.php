<?php

use Illuminate\Database\Seeder;

class AccessSite extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_sites')->insert([
            'client_id' => '0',
            'admin_panel_url' => '/wplogin',
            'login' => 'admin',
            'password' => '192.345.345.23',
            'comment' => '',
        ]);

        DB::table('access_sites')->insert([
            'client_id' => '1',
            'admin_panel_url' => '/wplogin',
            'login' => 'admin',
            'password' => '192.345.345.23',
            'comment' => '',
        ]);

        DB::table('access_sites')->insert([
            'client_id' => '2',
            'admin_panel_url' => '/wplogin',
            'login' => 'admin',
            'password' => '192.345.345.23',
            'comment' => '',
        ]);
    }
}
