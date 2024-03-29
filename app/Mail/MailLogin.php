<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailLogin extends Mailable
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
                ->view('emails.mail_login_doctor')
                ->with([
                    'doctorName' => $this->user->name,
                    'doctorEmail' => $this->user->email,
                    'doctorPassword' => 'Aa@123456'
                ]);
    }
}
