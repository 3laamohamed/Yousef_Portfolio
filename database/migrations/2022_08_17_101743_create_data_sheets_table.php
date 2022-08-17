<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('visitors')->default('0');
            $table->integer('projects')->default('0');
            $table->integer('status_v')->default('0');
            $table->integer('status_p')->default('0');
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
        Schema::dropIfExists('data_sheets');
    }
}
