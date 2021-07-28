<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BookshelfItemType;

class AddBookshelfItemType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookshelf_items', function (Blueprint $table) {
            $table->tinyInteger('type')->unsigned()->default(BookshelfItemType::TemporaryLoan);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookshelf_items', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
}
