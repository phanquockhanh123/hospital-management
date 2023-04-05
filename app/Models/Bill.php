<?php

namespace App\Models;

class Bill extends BaseModel
{
    //status
    public const STATUS_DENIED = 0;
    public const STATUS_PENDING = 1;
    public const STATUS_ACCEPTED = 2;

    public static $status = [
        self::STATUS_PENDING => 'Đang chờ',
        self::STATUS_ACCEPTED => 'Chấp nhận ',
        self::STATUS_DENIED => 'Từ chối',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'total_money',
        'paid_money',
        'note'
    ];

    protected $dates = [
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
     * Get the patient
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
