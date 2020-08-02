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
            'title' => encrypt('jino.ru'),
            'link_sign_in' => encrypt('https://jino.ru'),
            'host_login' => encrypt('admin'),
            'host_password' => encrypt('qwertyu123'),
            'ftp_server' => encrypt('192.345.345.23'),
            'ftp_login' => encrypt('admin.jino'),
            'ftp_password' => encrypt('qwertyu123'),
            'comment' => encrypt('site.ru, site.org'),
        ]);

        DB::table('access_hosts')->insert([
            'title' => encrypt('nic.ru'),
            'link_sign_in' => encrypt('https://nic.ru'),
            'host_login' => encrypt('admin'),
            'host_password' => encrypt('qwertyu123'),
            'ftp_server' => encrypt('36.345.345.23'),
            'ftp_login' => encrypt('admin.jino'),
            'ftp_password' => encrypt('qwertyu123'),
            'comment' => encrypt('site.ru, site.org'),
        ]);

        DB::table('access_hosts')->insert([
            'title' => encrypt('sweb.ru'),
            'link_sign_in' => encrypt('https://sweb.ru'),
            'host_login' => encrypt('admin'),
            'host_password' => encrypt('qwertyu123'),
            'ftp_server' => encrypt('12.345.345.23'),
            'ftp_login' => encrypt('admin.jino'),
            'ftp_password' => encrypt('qwertyu123'),
            'comment' => encrypt('www.edu.site.ru, site.org'),
        ]);
    }
}
