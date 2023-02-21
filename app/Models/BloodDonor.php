<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonor extends BaseModel
{
    //gender
    public const FEMALE = 0;
    public const MALE = 1;

    public static $genders = [
        self::MALE => 'Nam',
        self::FEMALE => 'Nu',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'blood_group_id'
    ];

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     /**
     * Get the bloodGroup
     */
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

     /**
     * Get the hasMany bloodDonation
     */
    public function bloodDonation()
    {
        return $this->hasMany(BloodDonation::class);
    }
}
