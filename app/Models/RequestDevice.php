<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDevice extends BaseModel
{
    //status
    public const STATUS_BORROWING = 0;
    public const STATUS_RETURNED = 1;

    public static $status = [
        self::STATUS_BORROWING => 'Đang mượn ',
        self::STATUS_RETURNED => 'Đã trả',
    ];
    protected $fillable =[
        'patient_id',
        'doctor_id',
        'borrow_time',
        'return_time',
        'status'
    ];

    protected $dates = [
        'borrow_time',
        'return_time',
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
     * Get the requestDeviceItems
     */
    public function requestDeviceItems()
    {
        return $this->hasMany(RequestDeviceItem::class);
    }

}
