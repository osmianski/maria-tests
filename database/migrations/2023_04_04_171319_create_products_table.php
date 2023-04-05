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

            $table->uuid()->unique();

            // Type, see `App\Enums\FileCollections`
            $table->string('collection', 20);

            // A user that submitted this file, and his legal
            // responsibility record
            $table->unsignedInteger('author_id');
            $table->string('copyright_notice')->nullable();
            $table->dateTime('copyright_approved_at')->nullable();

            // How it's displayed
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('position')->default(0);

            // How it's stored
            $table->string('disk', 20);
            $table->text('path');
            $table->string('mime_type', 80);
            $table->unsignedBigInteger('size');
            $table->json('meta_data')->nullable();

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
