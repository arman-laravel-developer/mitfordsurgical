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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('password')->nullable();
            $table->text('remember_token')->nullable();
            $table->string('verification_code')->nullable();
            $table->timestamp('verification_code_send_time')->nullable();
            $table->tinyInteger('is_verified')->default(2);
            $table->double('rating')->nullable();
            $table->integer('num_of_reviews')->nullable();
            $table->integer('num_of_sale')->nullable();
            $table->tinyInteger('verification_status')->default(2);
            $table->longText('verification_info')->nullable();
            $table->tinyInteger('cash_on_delivery_status')->default(2);
            $table->double('admin_to_pay')->default(0.00);
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('bank_routing_no')->nullable();
            $table->tinyInteger('bank_payment_status')->default(2);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sellers');
    }
};
