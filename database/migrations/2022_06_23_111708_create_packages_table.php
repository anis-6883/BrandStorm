<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('package_title');
            $table->text('package_slug');
            $table->text('package_summary')->nullable();
            $table->mediumText('package_description');
            $table->double('package_cost', 8, 2);
            $table->enum('subscription_type', ['Daily', 'Weekly', 'Monthly', 'Yearly']);
            $table->text('package_image')->nullable();
            $table->integer('package_discount_pct')->nullable();
            $table->dateTimeTz('discount_start_date')->nullable();
            $table->dateTimeTz('discount_end_date')->nullable();
            $table->integer('duration_hour')->nullable();
            $table->integer('reach_head')->nullable();
            $table->string('print_ad_size')->nullable();
            $table->string('billboard_location')->nullable();
            $table->string('video_length')->nullable();
            $table->integer('package_order')->default(0);
            $table->enum('package_status', ['Active', 'Inactive'])->default('Inactive');
            $table->dateTimeTz('created_at');
            $table->dateTimeTz('updated_at');
            // $table->unsignedBigInteger('subcategory_id');
            // $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('packages');
    }
}
