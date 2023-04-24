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

            $table->bigInteger('brand_id')->unsigned();

            $table->foreign('brand_id')->references('id')->on('product_brands');

            $table->bigInteger('category_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('product_categories');

            $table->string('title');

            $table->string('title_en');

            $table->string('slug');

            $table->softDeletes();

            $table->timestamps();
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
