<?php

namespace App\Mail;

use App\Enums\LedgeStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class BookReturnRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ledge;

    /**
     * Create a new message instance.
     *
     * @param $ledge
     */
    public function __construct($ledge)
    {
        $this->ledge = $ledge;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $status = $this->ledge->status === LedgeStatus::AwaitingReturn ? 'accepted' : 'rejected';
        Config::set('mail.username', 'support@booksbank.com');
        return $this->view('mail.book-return-request-status-mail')
                    ->from('noreply@booksbank.com','BooksBank')
                    ->subject("Your Book return request has been $status");
    }
}
