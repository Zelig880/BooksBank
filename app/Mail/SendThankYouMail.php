<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SendThankYouMail extends Mailable implements ShouldQueue
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
        Config::set('mail.username', 'support@booksbank.co.uk');
        return $this->view('mail.thank-you-mail')
                    ->from('noreply@booksbank.co.uk', 'BooksBank')
                    ->subject("Thank you!");
    }
}
