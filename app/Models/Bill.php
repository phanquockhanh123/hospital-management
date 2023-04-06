<?php

namespace App\Models;

class Bill extends BaseModel
{

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
        'note'
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
