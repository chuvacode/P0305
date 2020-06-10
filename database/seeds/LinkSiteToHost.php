<?php

use Illuminate\Database\Seeder;

class LinkSiteToHost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link_site_to_hosts')->insert([
            'site_id' => '0',
            'host_id' => '0'
        ]);

        DB::table('link_site_to_hosts')->insert([
            'site_id' => '1',
            'host_id' => '1'
        ]);

        DB::table('link_site_to_hosts')->insert([
            'site_id' => '2',
            'host_id' => '2'
        ]);
    }
}
