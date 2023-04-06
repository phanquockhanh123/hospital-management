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
        'diagnosis_id',
        'note'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the diagnosis
     */
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
     /**
     * Get the prescriptionItems
     */
    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
