<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class BookReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lender)
    {
        //
        $this->lender = $lender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        Config::set('mail.username', 'support@booksbank.com');
        return $this->view('mail.book-request-mail')
            ->from('noreply@booksbank.com', 'BooksBank')
            ->subject("Your Book is awaiting return");
    }
}