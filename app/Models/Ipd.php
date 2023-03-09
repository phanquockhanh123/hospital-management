<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipd extends BaseModel
{
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

    //patient status
    public const PATIENT_NEW = 0;
    public const PATIENT_OLD = 1;

    public static $isOldPatient = [
        self::PATIENT_NEW => 'Bệnh nhân mới',
        self::PATIENT_OLD => 'Bệnh nhân cũ',
    ];

    //patient status
    public const PATIENT_IN = 0;
    public const PATIENT_OUT = 1;

    public static $patientStatus = [
        self::PATIENT_IN => 'Bệnh nhân nhập viện',
        self::PATIENT_OUT => 'Bệnh nhân xuất viện',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ipd_code',
        'patient_id',
        'doctor_id',
        'bed_id',
        'blood_group',
        'height',
        'weight',
        'blood_pressure',
        'addmission_date',
        'symptoms',
        'notes',
        'is_old_patient',
        'patient_status'
    ];

    protected $dates = [
        'addmission_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /*
     * Function generate next code
     *
     * @return string
     */
    public static function generateNextCode()
    {
        $maxIdentifierCode = self::withTrashed()->max('ipd_code');
        if (empty($maxIdentifierCode)) {
            // Table bed no record
            return sprintf('%s00001', config('const.prefix_code.ipd_opd_patient'));
        }
        return sprintf(
            "%s%'.05s",
            config('const.prefix_code.ipd_opd_patient'),
            substr($maxIdentifierCode, strlen(config('const.prefix_code.ipd_opd_patient'))) + 1
        );
    }

    /**
     * Get the patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the bed
     */
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
