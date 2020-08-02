<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_sites', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('site_url');
            $table->longText('admin_panel_url');
            $table->longText('admin_panel_login');
            $table->longText('admin_panel_password');
            $table->longText('ftp_server')->nullable();
            $table->longText('ftp_login')->nullable();
            $table->longText('ftp_password')->nullable();
            $table->longText('db_server')->nullable();
            $table->longText('db_name')->nullable();
            $table->longText('db_login')->nullable();
            $table->longText('db_password')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_sites');
    }
}
