<?php

namespace App\Models;

class Bill extends BaseModel
{
    //status
    public const STATUS_NO_PAYMENT = 0;
    public const STATUS_PAYMENT = 1;

    public static $status = [
        self::STATUS_NO_PAYMENT => 'Chưa thanh toán',
        self::STATUS_PAYMENT => 'Đã thanh toán',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'diagnosis_id',
        'prescription_id',
        'total_money',
        'paid_money',
        'note',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the prescription
     */
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    /**
     * Get the diagnosis
     */
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

}
