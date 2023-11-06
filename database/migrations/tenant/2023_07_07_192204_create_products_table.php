<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('head_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('sku', 100)->nullable();
            $table->string('cost_price', 25)->nullable();
            $table->string('selling_price', 25)->nullable();
            $table->string('barcode', 25)->nullable();
            $table->decimal('quantity', 10, 2)->default(0);
            $table->tinyInteger('product_types')->default(0);
            $table->tinyInteger('manage_inventory')->nullable()->default(1);
            $table->decimal('weight', 10, 2)->default(0);
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
        Schema::create('product_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->timestamps();
        });
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->integer('group_id')->nullable();
            $table->timestamps();
        });
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_product_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('value_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_attribute_groups');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_attributes');
    }
};
