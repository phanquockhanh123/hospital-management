<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDeviceItem extends BaseModel
{

    protected $fillable =[
        'request_device_id',
        'medical_device_id',
        'quantity',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the requestDevice
     */
    public function requestDevice()
    {
        return $this->belongsTo(RequestDevice::class);
    }

    /**
     * Get the medicalDevice
     */
    public function medicalDevice()
    {
        return $this->belongsTo(MedicalDevice::class);
    }
}
