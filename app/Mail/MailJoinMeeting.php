<?php

namespace App\Mail;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailJoinMeeting extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $meeting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Meeting $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thư mời tham gia cuộc họp ')
                ->view('emails.mail_join_meeting')
                ->with([
                    'userName' => $this->user->name,
                    'meetingId' => $this->meeting->meeting_id,
                    'meetingName' => $this->meeting->meeting_name,
                    'meetingPassword' => $this->meeting->meeting_password,
                    'joinUrl' => $this->meeting->join_url,
                ]);
    }
}
