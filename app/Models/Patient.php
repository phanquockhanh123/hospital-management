<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends BaseModel
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

    //gender
    public const FEMALE = 0;
    public const MALE = 1;

    public static $genders = [
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
        'patient_code',
        'blood_group',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'profile',
        'filename',
        'address',
        'identity_number',
        'identity_card_date',
        'identity_card_place',
    ];

    protected $dates = [
        'identity_card_date',
        'date_of_birth',
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
        $maxIdentifierCode = self::withTrashed()->max('patient_code');
        if (empty($maxIdentifierCode)) {
            // Table bed no record
            return sprintf('%s00001', config('const.prefix_code.patient'));
        }
        return sprintf(
            "%s%'.05s",
            config('const.prefix_code.patient'),
            substr($maxIdentifierCode, strlen(config('const.prefix_code.patient'))) + 1
        );
    }

    /**
     * Get the diagnosises
     */
    public function diagnosises()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
