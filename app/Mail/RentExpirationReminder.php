<?php

namespace App\Mail;

use App\Models\Tennants;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentExpirationReminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $tennant;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Tennants  $tennant
     * @return void
     */
    public function __construct(Tennants $tennant)
    {
        $this->tennant = $tennant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rent Expiration Reminder')
                    ->view('emails.rent-expiration-reminder', ['tennant' => $this->tennant]);
    }
}
