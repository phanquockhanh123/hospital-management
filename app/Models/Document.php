<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends BaseModel
{
    // documentTypes
    public const TYPE_X_QUANG = 0;
    public const CLS = 1;
    public const GENERAL_PROFILE = 2;
    public const MRI = 3;
    public const SUPERSONIC = 4;

    public static $documentTypes = [
        self::TYPE_X_QUANG => 'X-Quang',
        self::CLS => 'CLS',
        self::GENERAL_PROFILE => 'Hồ sơ tổng quát',
        self::MRI => 'MRI',
        self::SUPERSONIC => 'Siêu âm',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'patient_id',
        'doctor_id',
        'note',
        'document_type',
        'document_file',
        'filename',
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
