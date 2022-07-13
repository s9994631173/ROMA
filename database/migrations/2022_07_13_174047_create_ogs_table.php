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
        Schema::create('ogs', function (Blueprint $table) {
            $table->id();
            $table->string('itemName');
            $table->string('classHazard')->default();
            $table->string('avia')->default();
            $table->string('additional_fee')->default();
            $table->string('auto')->default();
            $table->text('note');
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
        Schema::dropIfExists('ogs');
    }
};
