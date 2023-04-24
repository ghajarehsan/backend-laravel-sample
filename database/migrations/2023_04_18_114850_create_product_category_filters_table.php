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
        Schema::create('product_category_filters', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('type')->comment('1:multiple,0:single');

            $table->string('name');

            $table->bigInteger('product_category_id')->unsigned();

            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');

            $table->bigInteger('creator_id')->unsigned();

            $table->foreign('creator_id')->references('id')->on('users');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_filters');
    }
};
