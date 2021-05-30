<?php

namespace App\Jobs;

use App\Enums\LedgeStatus;
use App\Models\Ledge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PickupBookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ledges = Ledge::with(['book', 'borrower', 'lender'])->get();
        $ledges->filter(function ($ledge) {
            return $ledge->status = LedgeStatus::AwaitingReturn;
        });
    }
}
