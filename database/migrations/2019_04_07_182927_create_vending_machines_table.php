<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendingMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vending_machines', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('inserted_money',5,2);
            //$table->decimal('available_change',8,2);
            $table->decimal('short_change',8,2);
            $table->string('string_change')->default('');
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
        Schema::dropIfExists('vending_machines');
    }
}
