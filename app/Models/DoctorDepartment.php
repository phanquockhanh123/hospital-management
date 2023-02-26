<?php

namespace App\Models;

class DoctorDepartment extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the doctorDepartment
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Get the beds
     */
    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
