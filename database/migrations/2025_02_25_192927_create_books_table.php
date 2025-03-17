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
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('publish_year');
            $table->string('isbn');
            $table->string('description');
            $table->string('image');
            $table->string('file');
            $table->string('price')->nullable();
            $table->string('pageNumber');
            $table->string('size');

            $table->boolean('is_active')->default(0);

            $table->boolean('is_premium')->default(0);

            $table->boolean('is_trending')->default(0);

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('book_language_id');
            $table->foreign('book_language_id')->references('id')->on('book_languages')->restrictOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('book_auth_id');
            $table->foreign('book_auth_id')->references('id')->on('book_auths')->restrictOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('publication_id');
            $table->foreign('publication_id')->references('id')->on('publications')->restrictOnDelete()->cascadeOnUpdate();


            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
