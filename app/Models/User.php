<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // role
    public const ROLE_PATIENT = 0;
    public const ROLE_RECEPTIONIST = 1;
    public const ROLE_DOCTOR =2;
    public const ROLE_ADMIN_ROOT = 3;

    public static $roles = [
        self::ROLE_RECEPTIONIST => 'Lễ tân',
        self::ROLE_DOCTOR => 'Bác sĩ',
        self::ROLE_ADMIN_ROOT => 'Root',
        self::ROLE_PATIENT => 'Bệnh nhân',
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
        'role',
        'email',
        'status',
        'password',
        'profile',
        'filename',
        'profile_photo_path',
        'google_id',
        'google_token',
        'google_refresh_token',
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

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function receptionist()
    {
        return $this->hasOne(Receptionist::class);
    }
}
