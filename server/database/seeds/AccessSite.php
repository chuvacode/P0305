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
            'title' => encrypt('psyname.ru'),
            'site_url' => encrypt('http://psyname.ru'),
            'admin_panel_url' => encrypt('http://psyname.ru/wplogin'),
            'admin_panel_login' => encrypt('admin'),
            'admin_panel_password' => encrypt('qwertyu123'),
            'ftp_server' => encrypt('132.123.123.123'),
            'ftp_login' => encrypt('admin'),
            'ftp_password' => encrypt('qwertyu123'),
            'db_server' => encrypt('localhost'),
            'db_name' => encrypt('psyname_db'),
            'db_login' => encrypt('root'),
            'db_password' => encrypt('qwertyu123'),
            'comment' => encrypt(''),
        ]);

        DB::table('access_sites')->insert([
            'title' => encrypt('rgkript.ru'),
            'site_url' => encrypt('http://rgkript.ru'),
            'admin_panel_url' => encrypt('http://rgkript.ru/wplogin'),
            'admin_panel_login' => encrypt('admin'),
            'admin_panel_password' => encrypt('qwertyu123'),
            'ftp_server' => encrypt('32.123.123.123'),
            'ftp_login' => encrypt('admin'),
            'ftp_password' => encrypt('qwertyu123'),
            'db_server' => encrypt('localhost'),
            'db_name' => encrypt('rgkript_db'),
            'db_login' => encrypt('root'),
            'db_password' => encrypt('qwertyu123'),
            'comment' => encrypt(''),
        ]);

        DB::table('access_sites')->insert([
            'title' => encrypt('french-urolog.ru'),
            'site_url' => encrypt('http://french-urolog.ru'),
            'admin_panel_url' => encrypt('http://french-urolog.ru/wplogin'),
            'admin_panel_login' => encrypt('admin'),
            'admin_panel_password' => encrypt('face-password'),
            'ftp_server' => encrypt('98.123.123.123'),
            'ftp_login' => encrypt('admin'),
            'ftp_password' => encrypt('face-password'),
            'db_server' => encrypt('localhost'),
            'db_name' => encrypt('french_urolog_db'),
            'db_login' => encrypt('root'),
            'db_password' => encrypt('face-password'),
            'comment' => encrypt(''),
        ]);
    }
}
