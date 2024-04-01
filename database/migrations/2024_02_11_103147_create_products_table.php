<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->integer('child_category_id')->nullable();
            $table->integer('brand_id')->nullable();

            $table->string('product_name' ,100);
            $table->string('product_code' ,100)->nullable();
            $table->string('product_unit' ,100)->nullable();
            $table->string('product_model' ,100)->nullable();
            $table->string('product_tags' ,100)->nullable();
            $table->string('product_video' ,100)->nullable();
            $table->string('purchase_price' ,100)->nullable();
            $table->string('selling_price' ,100)->nullable();
            $table->string('discount_price' ,100)->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('warehouse' ,100)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('feature')->nullable();
            $table->integer('today_dela')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->integer('cash_on_delivery')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('is_discount')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};