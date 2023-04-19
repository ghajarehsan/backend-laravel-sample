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
        Schema::create('product_category_filter_options', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->bigInteger('category_filter_id')->unsigned();

            $table->foreign('category_filter_id')->references('id')->on('product_category_filters')->onDelete('cascade');

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
        Schema::dropIfExists('product_category_filter_options');
    }
};
