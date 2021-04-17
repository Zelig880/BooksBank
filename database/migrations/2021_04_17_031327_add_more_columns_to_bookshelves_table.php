<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToBookshelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookshelves', function (Blueprint $table) {
            $table->text('opening_days')->nullable()->after('latitude');
            $table->text('opening_hours')->nullable()->after('opening_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookshelves', function (Blueprint $table) {
            $table->dropColumn(['opening_days', 'opening_hours']);
        });
    }
}
