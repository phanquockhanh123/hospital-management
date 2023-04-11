<?php

namespace App\Models;

class Diagnosis extends BaseModel
{
    protected $table = 'diagnosis';

    //status
    public const STATUS_PENDING = 0;
    public const STATUS_CREATED = 1;

    public static $status = [
        self::STATUS_PENDING => 'Chưa tạo đơn thuốc',
        self::STATUS_CREATED => 'Đã tạo đơn ',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'main_diagnosis',
        'side_diagnosis',
        'note',
        'status'
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
     * Get the doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the diagnosisItems
     */
    public function diagnosisItems()
    {
        return $this->hasMany(DiagnosisItem::class);
    }

    /**
     * Get the bill
     */
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
