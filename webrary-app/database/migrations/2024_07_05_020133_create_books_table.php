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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('year_published');
            $table->string('genre');
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->integer('rating')->check('rating >= 1 AND rating <= 5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
