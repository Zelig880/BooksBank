<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LedgeStatus;

class CreateLedgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledge', function (Blueprint $table) {
            $table->id();
            $table->integer('lender');
            $table->integer('borrower');
            $table->tinyInteger('status')->unsigned()->default(LedgeStatus::WaitingApproval);
            $table->dateTime('return')->nullable();
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
        Schema::dropIfExists('ledge');
    }
}
