<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_fights_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFightsTable extends Migration
{
    public function up()
    {
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player1_id');
            $table->unsignedBigInteger('player2_id');
            $table->integer('player1_legs')->default(0);
            $table->integer('player2_legs')->default(0);
            $table->integer('player1_points')->default(501);
            $table->integer('player2_points')->default(501);
            $table->integer('player1_darts')->default(0);
            $table->integer('player2_darts')->default(0);
            $table->timestamps();

            $table->foreign('player1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('player2_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fights');
    }
}

