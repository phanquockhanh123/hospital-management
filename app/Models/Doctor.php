<?php

namespace App\Models;

use App\Models\BloodGroup;
use App\Models\DoctorDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'doctor_department_id',
        'blood_group_id',
        'email',
        'designation',
        'phone',
        'academic_level',
        'date_of_birth',
        'gender',
        'status',
        'profile',
        'address',
    ];

    protected $dates = [
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
     * Get the bloodGroup
     */
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }
}
