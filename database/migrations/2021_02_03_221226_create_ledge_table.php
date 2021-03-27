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
        Schema::create('ledges', function (Blueprint $table) {
            $table->id();
            $table->integer('lender_id');
            $table->integer('borrower_id');
            $table->integer('book_id');
            $table->integer('bookshelf_item_id');
            $table->tinyInteger('status')->unsigned()->default(LedgeStatus::WaitingApproval);
            $table->integer('lend_duration')->default(14);
            $table->dateTime('pickup_date');
            $table->dateTime('return_date')->nullable();
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
