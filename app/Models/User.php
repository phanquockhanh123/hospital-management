<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // role
    public const ROLE_MEMBER = 0;
    public const ROLE_PATIENT = 1;
    public const ROLE_DOCTOR = 2;
    public const ROLE_ADMIN_ROOT = 3;

    public static $roles = [
        self::ROLE_MEMBER => 'Member',
        self::ROLE_PATIENT => 'Patient',
        self::ROLE_DOCTOR => 'Doctor',
        self::ROLE_ADMIN_ROOT => 'Root',
    ];


    // status
    public const STATUS_ACTIVE = 1;
    public const STATUS_DEACTIVATED = 0;

    public static $status = [
        self::STATUS_ACTIVE => 'Đang hoạt động',
        self::STATUS_DEACTIVATED => 'Đã vô hiệu',
    ];

    // gender
    public const MALE = 1;
    public const FEMALE = 0;

    public static $gender = [
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
        'email',
        'phone',
        'gender',
        'address',
        'role',
        'dob',
        'status',
        'password',
        'profile',
        'filename'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
