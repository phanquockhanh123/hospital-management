<?php

namespace App\Models;

class Diagnosis extends BaseModel
{
    protected $table = 'diagnosis';
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
        return $this->has(DiagnosisItem::class);
    }
}
