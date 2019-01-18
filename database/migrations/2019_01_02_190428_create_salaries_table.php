<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');            
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('work_days')->nullable();
            $table->integer('over_days')->nullable();
            $table->integer('total_sales')->nullable();
            $table->integer('comission_percent')->nullable();
            $table->integer('comission')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('gross_salary')->nullable();
            $table->integer('total_salary')->nullable();
            $table->integer('advance')->nullable();
            $table->integer('to_be_paid')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
