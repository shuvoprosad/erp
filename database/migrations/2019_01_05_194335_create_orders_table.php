<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('agent_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('counter')->nullable();
            $table->integer('offer_price')->nullable();
            $table->string('status_0')->nullable();
            $table->text('note_1')->nullable();
            $table->unsignedInteger('shipped_by')->nullable();
            $table->string('shipping_method')->nullable();
            $table->integer('last_balance')->nullable();
            $table->string('last_number')->nullable();
            $table->string('cn')->nullable();
            $table->string('status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->string('note_2')->nullable();
            $table->text('note_extension')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
