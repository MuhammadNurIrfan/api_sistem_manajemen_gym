<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vending_machines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('vending_machine_datetime'); 
            $table->bigInteger('terminal_id'); 
            $table->bigInteger('card_id'); 
            $table->integer('nominal');
            $table->integer('total_minuman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vending_machines');
    }
};
