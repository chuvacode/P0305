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
            'title' => 'psyname.ru',
            'site_url' => 'http://psyname.ru',
            'admin_panel_url' => 'http://psyname.ru/wplogin',
            'admin_panel_login' => 'admin',
            'admin_panel_password' => 'face-password',
            'ftp_server' => '132.123.123.123',
            'ftp_login' => 'admin',
            'ftp_password' => 'face-password',
            'db_server' => 'localhost',
            'db_name' => 'psyname_db',
            'db_login' => 'root',
            'db_password' => 'face-password',
            'comment' => '',
        ]);

        DB::table('access_sites')->insert([
            'title' => 'rgkript.ru',
            'site_url' => 'http://rgkript.ru',
            'admin_panel_url' => 'http://rgkript.ru/wplogin',
            'admin_panel_login' => 'admin',
            'admin_panel_password' => 'face-password',
            'ftp_server' => '32.123.123.123',
            'ftp_login' => 'admin',
            'ftp_password' => 'face-password',
            'db_server' => 'localhost',
            'db_name' => 'rgkript_db',
            'db_login' => 'root',
            'db_password' => 'face-password',
            'comment' => '',
        ]);

        DB::table('access_sites')->insert([
            'title' => 'french-urolog.ru',
            'site_url' => 'http://french-urolog.ru',
            'admin_panel_url' => 'http://french-urolog.ru/wplogin',
            'admin_panel_login' => 'admin',
            'admin_panel_password' => 'face-password',
            'ftp_server' => '98.123.123.123',
            'ftp_login' => 'admin',
            'ftp_password' => 'face-password',
            'db_server' => 'localhost',
            'db_name' => 'french_urolog_db',
            'db_login' => 'root',
            'db_password' => 'face-password',
            'comment' => '',
        ]);
    }
}
