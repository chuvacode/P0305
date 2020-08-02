<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_hosts', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('link_sign_in');
            $table->longText('host_login');
            $table->longText('host_password');
            $table->longText('ftp_server')->nullable();
            $table->longText('ftp_login')->nullable();
            $table->longText('ftp_password')->nullable();
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
        Schema::dropIfExists('access_hosts');
    }
}
