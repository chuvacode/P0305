<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_others', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('login')->nullable();
            $table->longText('password');
            $table->longText('email')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('link_sign_in')->nullable();
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
        Schema::dropIfExists('access_others');
    }
}
