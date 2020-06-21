<?php

use Illuminate\Database\Seeder;

class AccessHost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_hosts')->insert([
            'title' => 'jino.ru',
            'link_sign_in' => 'https://jino.ru',
            'host_login' => 'admin',
            'host_password' => 'qwertyu123',
            'ftp_server' => '192.345.345.23',
            'ftp_login' => 'admin.jino',
            'ftp_password' => 'qwertyu123',
            'comment' => 'site.ru, site.org',
        ]);

        DB::table('access_hosts')->insert([
            'title' => 'nic.ru',
            'link_sign_in' => 'https://nic.ru',
            'host_login' => 'admin',
            'host_password' => 'qwertyu123',
            'ftp_server' => '36.345.345.23',
            'ftp_login' => 'admin.jino',
            'ftp_password' => 'qwertyu123',
            'comment' => 'site.ru, site.org',
        ]);

        DB::table('access_hosts')->insert([
            'title' => 'sweb.ru',
            'link_sign_in' => 'https://sweb.ru',
            'host_login' => 'admin',
            'host_password' => 'qwertyu123',
            'ftp_server' => '12.345.345.23',
            'ftp_login' => 'admin.jino',
            'ftp_password' => 'qwertyu123',
            'comment' => 'www.edu.site.ru, site.org',
        ]);
    }
}
