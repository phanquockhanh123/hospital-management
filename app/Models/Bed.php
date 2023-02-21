<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends BaseModel
{

    //status
    public const STATUS_EMPTY= 0;
    public const STATUS_FULL = 1;

    public static $status = [
        self::STATUS_EMPTY => 'Trống',
        self::STATUS_FULL => 'Đầy',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'bed_code',
        'name',
        'bed_type_id',
        'charge',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the bedType
     */
    public function bedType()
    {
        return $this->belongsTo(BedType::class);
    }
}
