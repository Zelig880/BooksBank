<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BookCondition;
use App\Enums\BookStatus;

class CreateBookshelfItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookshelf_items');
        Schema::create('bookshelf_items', function (Blueprint $table) {
            $table->id();
            $table->integer("bookshelf_id");
            $table->integer("book_id");
            $table->tinyInteger('condition')->unsigned()->default(BookCondition::Good);
            $table->tinyInteger('status')->unsigned()->default(BookStatus::Available);
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
        Schema::dropIfExists('Bookshelf_item');
    }
}
