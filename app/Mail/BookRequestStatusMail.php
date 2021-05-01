<?php

namespace App\Mail;

use App\Enums\LedgeStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class BookRequestStatusMail extends Mailable
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
        $status = $this->ledge->status === LedgeStatus::WaitingPickup ? 'accepted' : 'rejected';
        Config::set('mail.username', 'support@booksbank.com');
        return $this->view('mail.book-request-mail')
                    ->from('noreply@booksbank.com','BooksBank')
                    ->subject("Your Book request has been $status");
    }
}
