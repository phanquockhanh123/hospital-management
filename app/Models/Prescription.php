<?php

namespace App\Models;

class Prescription extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'main_disease',
        'side_disease',
        'medical_name',
        'dosage',
        'dosage_note',
        'unit',
        'amount',
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
