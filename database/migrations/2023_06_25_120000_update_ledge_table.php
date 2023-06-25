<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLedgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('ledges', function (Blueprint $table) {
            $table->string('pickup_day', 64)->after('pickup_date');
            $table->string('pickup_time', 64)->after('pickup_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledges', function (Blueprint $table) {
            $table->dropColumn('pickup_day');
            $table->dropColumn('pickup_time');
        });
    }
}
