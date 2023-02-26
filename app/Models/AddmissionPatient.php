<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddmissionPatient extends BaseModel
{

    //status
    public const STATUS_HOSPITALIZED = 1;
    public const STATUS_PENDING = 0;

    public static $status = [
        self::STATUS_HOSPITALIZED => 'Đã nhập viện',
        self::STATUS_PENDING => 'Đang chờ xử lý',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'bed_id',
        'addmission_date',
        'reason',
        'health_condition',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
        'guardian_address',
        'status',
        'description',
    ];

    protected $dates = [
        'addmission_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the bed
     */
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

}
