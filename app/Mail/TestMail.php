<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $ledge
     */
    public function __construct($ledge)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Config::set('mail.username', 'support@booksbank.com');
        return $this->view('mail.test')
                    ->from('noreply@booksbank.com','BooksBank')
                    ->subject('Test');
    }
}
