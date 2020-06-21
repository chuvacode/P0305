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
            $table->string('title', 50);
            $table->string('link_sign_in', 255);
            $table->string('host_login', 30);
            $table->string('host_password', 255);
            $table->string('ftp_server', 30)->nullable();
            $table->string('ftp_login', 30)->nullable();
            $table->string('ftp_password', 255)->nullable();
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
        Schema::dropIfExists('access_hosts');
    }
}
