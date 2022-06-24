<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('payment_type')->nullable(); 
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('invoice_no')->nullable();
            $table->dateTimeTz('order_date')->nullable();
            $table->string('discount_coupon')->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->double('before_discount', 8, 2)->nullable();
            $table->double('total_cost', 8, 2);
            $table->enum('order_status', ['Ordered', 'Pending', 'Processing', 'Completed', 'Cancelled'])->default('Ordered');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            // $table->timestamps();
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
