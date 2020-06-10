<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         $this->call(AccessHost::class);
         $this->call(AccessSite::class);
         $this->call(Client::class);
         $this->call(LinkSiteToHost::class);
    }
}
