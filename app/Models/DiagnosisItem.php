<?php

namespace App\Models;

class DiagnosisItem extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'diagnosis_id',
        'service_id',
        'result',
        'references_range',
        'unit',
        'method',
        'diagnosis_note'
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
     * Get the service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
