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
            $table->string('title', 50);
            $table->string('site_url', 255);
            $table->string('admin_panel_url', 255);
            $table->string('admin_panel_login', 30);
            $table->string('admin_panel_password', 255);
            $table->string('ftp_server', 50)->nullable();
            $table->string('ftp_login', 30)->nullable();
            $table->string('ftp_password', 255)->nullable();
            $table->string('db_server', 50)->nullable();
            $table->string('db_name', 30)->nullable();
            $table->string('db_login', 30)->nullable();
            $table->string('db_password', 255)->nullable();
            $table->string('comment', 255)->nullable();
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
