<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class PickupBookMail extends Mailable
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
        Config::set('mail.username', 'support@booksbank.com');
        return $this->view('mail.book-pickup-mail')
                    ->from('noreply@booksbank.com','BooksBank')
                    ->subject('Has the requested book been picked up?');
    }
}
