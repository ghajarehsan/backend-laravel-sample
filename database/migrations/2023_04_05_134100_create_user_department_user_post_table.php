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
        Schema::create('user_department_user_post', function (Blueprint $table) {

            $table->bigInteger('user_department_id')->unsigned();

            $table->foreign('user_department_id')->references('id')->on('user_departments')->onDelete('cascade');

            $table->bigInteger('user_post_id')->unsigned();

            $table->foreign('user_post_id')->references('id')->on('user_posts')->onDelete('cascade');

            $table->primary(['user_department_id', 'user_post_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_department_user_post');
    }
};
