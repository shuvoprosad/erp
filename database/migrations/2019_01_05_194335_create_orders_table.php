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
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('agent_id');
            $table->string('counter')->nullable();
            $table->string('status_0')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('Payment_number')->nullable();
            $table->string('Paid_amount')->nullable();
            $table->unsignedInteger('shipped_by')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('status_1')->nullable();
            $table->dateTime('date_status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->dateTime('date_status_2')->nullable();
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
