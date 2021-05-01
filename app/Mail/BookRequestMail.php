<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class BookRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $result;

    /**
     * Create a new message instance.
     *
     * @param $result
     */
    public function __construct($result)
    {
        $this->result = $result;
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
                    ->from('noreply@booksbank.com','BooksBank')
                    ->subject('Your Book request has been made');
    }
}
