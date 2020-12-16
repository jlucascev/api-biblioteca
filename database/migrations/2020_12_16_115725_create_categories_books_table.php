<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('categories_books');
        Schema::create('categories_books', function (Blueprint $table) {
            $table->id();

            $table->string("books_id",25);

            $table->foreign('books_id')->references('isbn')->on("books")->onDelete('cascade');
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_books');
    }
}
