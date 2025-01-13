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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('order_code')->nullable();
            $table->string('order_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->double('grand_total')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->integer('total_qty')->nullable();
            $table->text('address')->nullable();
            $table->text('order_note')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('order_status')->default('pending');
            $table->string('delivery_status')->default('pending');
            $table->tinyInteger('agreement')->nullable();
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
        Schema::dropIfExists('order');
    }
};
