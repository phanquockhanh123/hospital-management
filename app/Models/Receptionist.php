<?php

namespace App\Models;

class Receptionist extends BaseModel
{
    //gender
    public const FEMALE = 0;
    public const MALE = 1;

    public static $genders = [
        self::MALE => 'Nam',
        self::FEMALE => 'Nu',
    ];

    //status
    public const STATUS_ACTIVE = 1;
    public const STATUS_DEACTIVE = 0;

    public static $status = [
        self::STATUS_ACTIVE => 'Đang làm việc',
        self::STATUS_DEACTIVE => 'Đã nghỉ việc',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'designation',
        'phone',
        'date_of_birth',
        'gender',
        'status',
        'profile',
        'filename',
        'address',
        'identity_number',
        'identity_card_date',
        'identity_card_place',
        'start_work_date'
    ];

    protected $dates = [
        'start_work_date',
        'identity_card_date',
        'date_of_birth',
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
