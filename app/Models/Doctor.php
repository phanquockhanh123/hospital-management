<?php

namespace App\Models;

use App\Models\DoctorDepartment;

class Doctor extends BaseModel
{
    // academic level
    public const ACADEMIC_LEVEL_COLLEGES = 0;
    public const ACADEMIC_LEVEL_UNIVERSITY = 1;
    public const ACADEMIC_LEVEL_MASTERS = 2;
    public const ACADEMIC_LEVEL_PROFESSOR = 3;

    public static $academicLevels = [
        self::ACADEMIC_LEVEL_COLLEGES => 'Cao đẳng',
        self::ACADEMIC_LEVEL_UNIVERSITY => 'Đại học',
        self::ACADEMIC_LEVEL_MASTERS => 'Thạc sỹ',
        self::ACADEMIC_LEVEL_PROFESSOR => 'Giáo sư',
    ];

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

    //blood groups
    public const BLOOD_GROUP_O = 0;
    public const BLOOD_GROUP_A = 1;
    public const BLOOD_GROUP_B = 2;
    public const BLOOD_GROUP_AB = 3;

    public static $bloodGroups = [
        self::BLOOD_GROUP_O => 'Group O',
        self::BLOOD_GROUP_A => 'Group A',
        self::BLOOD_GROUP_B => 'Group B',
        self::BLOOD_GROUP_AB => 'Group AB',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'doctor_department_id',
        'user_id',
        'blood_group',
        'email',
        'designation',
        'phone',
        'academic_level',
        'date_of_birth',
        'gender',
        'status',
        'profile',
        'filename',
        'address',
        'identity_number',
        'identity_card_date',
        'identity_card_place',
        'start_work_date',
        'specialist'
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
     * Get the doctorDepartment
     */
    public function doctorDepartment()
    {
        return $this->belongsTo(DoctorDepartment::class);
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
