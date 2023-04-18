<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailLoginReceptionist extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
                ->subject('Thông tin đăng nhập tài khoản')
                ->view('emails.mail_login_receptionist')
                ->with([
                    'receptionistName' => $this->user->name,
                    'receptionistEmail' => $this->user->email,
                    'receptionistPassword' => 'Aa@123456'
                ]);
    }
}
