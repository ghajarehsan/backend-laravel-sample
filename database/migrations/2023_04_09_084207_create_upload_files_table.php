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
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('creator_id')->unsigned();

            $table->foreign('creator_id')->references('id')->on('users');

            $table->morphs('upload_file');

            $table->string('name');

            $table->string('path');

            $table->integer('size');

            $table->tinyInteger('is_private');

            $table->integer('time')->nullable();

            $table->string('mime');

            $table->string('extension');

            $table->tinyInteger('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
