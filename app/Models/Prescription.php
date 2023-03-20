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
        'name',
        'description',
        'expired_date',
        'quantity',
        'charge',
        'status',
        'filename',
        'profile'
    ];

    protected $dates = [
        'expired_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
