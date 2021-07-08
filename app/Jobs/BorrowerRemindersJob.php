<?php

namespace App\Jobs;

use App\Enums\LedgeStatus;
use App\Mail\BookReturnReminderMail;
use App\Mail\PickupBookMail;
use App\Mail\SendThankYouMail;
use App\Models\Ledge;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BorrowerRemindersJob implements ShouldQueue
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
        foreach ($ledges as $ledge)
        {
            $this->sendReminderMails($ledge);
        }
    }

    private function sendReminderMails(Ledge $ledge)
    {
        if ($ledge->status === LedgeStatus::WaitingPickup && $ledge->pickup_date !== NULL && $this->differenceInDaysBetweenTodayAndDate($ledge->pickup_date) === 1)
        {
            Mail::to($ledge->borrower->email)->queue(new PickupBookMail($ledge));
        }

        if ($ledge->status === LedgeStatus::InProgress && $ledge->return_date !== NULL && $this->differenceInDaysBetweenTodayAndDate($ledge->return_date) === 2)
        {
            $this->sendMail($ledge);
        }

        if ($ledge->status === LedgeStatus::InProgress && $ledge->return_date !== NULL && $this->differenceInDaysBetweenTodayAndDate($ledge->return_date) === 7)
        {
            $this->sendMail($ledge);
        }

        if ($ledge->status === LedgeStatus::AwaitingReturn && $ledge->return_date !== NULL && $this->differenceInDaysBetweenTodayAndDate($ledge->return_date) === 1)
        {
            $this->sendMail($ledge);
        }

        if ($ledge->status === LedgeStatus::Completed && $ledge->return_date !== NULL && $this->differenceInDaysBetweenTodayAndDate($ledge->updated_at) === 1)
        {
            Mail::to($ledge->borrower->email)->queue(new SendThankYouMail($ledge));
        }
    }

    private function differenceInDaysBetweenTodayAndDate($date)
    {
        return Carbon::parse($date)->diffInDays(Carbon::now());
    }

    private function sendMail(Ledge $ledge)
    {
        Mail::to($ledge->borrower->email)->queue(new BookReturnReminderMail($ledge));
    }
}
