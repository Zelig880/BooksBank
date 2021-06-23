<?php

namespace App\Jobs;

use App\Enums\LedgeStatus;
use App\Mail\BookRequestMail;
use App\Mail\BookReturnRequestMail;
use App\Models\Ledge;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LenderRemindersJob implements ShouldQueue
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
        $ledges = Ledge::with(['lender', 'borrower', 'book'])->get();
        foreach ($ledges as $ledge) {
            if ($ledge->status === LedgeStatus::ReturnRequested && Carbon::parse($ledge->updated_at)->isYesterday())
            {
                Mail::to($ledge->lender->email)->queue(new BookReturnRequestMail($ledge));
            }

            if ($ledge->status === LedgeStatus::WaitingApproval && Carbon::parse($ledge->updated_at)->isYesterday() && $ledge->pickup_date->format('H:i:s') <= now()->toTimeString())
            {
                Mail::to($ledge->lender->email)->queue(new BookRequestMail($ledge));
            }
        }
    }
}
