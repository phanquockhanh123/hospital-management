<?php

namespace App\Mail;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\DoctorDepartment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mockery\Generator\StringManipulation\Pass\Pass;

class MailDeniedBookAppoiment extends Mailable
{
    use Queueable, SerializesModels;

    protected $appointment;
    protected $doctor;
    protected $patient;
    protected $doctorDepartment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment, Patient $patient, Doctor $doctor, DoctorDepartment $doctorDepartment)
    {
        $this->appointment = $appointment;
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->doctorDepartment = $doctorDepartment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->patient->email)
                ->subject('Thân gửi quý khách')
                ->view('emails.mail_book_appointment')
                ->with([
                    'patientName' => $this->patient->name,
                    'patientCode' => $this->patient->patient_code,
                    'doctorName' => $this->doctor->name,
                    'doctorDepatment' => $this->doctorDepartment->name,
                    'startDate' => $this->appointment->start_date,
                    'endDate' => $this->appointment->end_date
                ]);
    }
}
