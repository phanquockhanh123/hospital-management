<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'remained_bags',
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
     * Get the bloodDonors
     */
    public function bloodDonors()
    {
        return $this->hasMany(BloodDonor::class);
    }
}
