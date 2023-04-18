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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('order')->default(1);

            $table->string('title');

            $table->string('title_en');

            $table->string('slug');

            $table->longText('images');

            $table->bigInteger('parent_id')->unsigned()->default(0);

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
        Schema::dropIfExists('product_categories');
    }
};
