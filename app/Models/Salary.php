<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends BaseModel
{
    //status
    public const STATUS_NO_PAYMENT = 0;
    public const STATUS_PAYMENT = 1;

    public static $status = [
        self::STATUS_NO_PAYMENT => 'Chưa thanh toán',
        self::STATUS_PAYMENT => 'Đã thanh toán',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'day_worked',
        'salary',
        'allowance',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
