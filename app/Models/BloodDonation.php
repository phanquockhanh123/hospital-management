<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonation extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'blood_donor_id',
        'bags',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     /**
     * Get the bloodDonor
     */
    public function bloodDonor()
    {
        return $this->belongsTo(BloodDonor::class);
    }
}
