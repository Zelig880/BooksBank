<?php

namespace App\Jobs;

use App\Mail\BookReturnReminderMail;
use App\Models\Ledge;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BookReturnReminderJob implements ShouldQueue
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
        $ledges = Ledge::all();
        foreach ($ledges as $ledge) {
            if ($ledge->return_date !== NULL && $this->differenceBetweenTodayAndDate($ledge->return_date) === 7)
            {
                Mail::to($ledge->borrower->email)->send(new BookReturnReminderMail($ledge));
            }
        }
    }

    private function differenceBetweenTodayAndDate($date)
    {
        return Carbon::parse($date)->diffInDays(Carbon::now());
    }
}
