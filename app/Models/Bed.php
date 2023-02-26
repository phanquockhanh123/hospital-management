<?php

namespace App\Models;

class Bed extends BaseModel
{

    //status
    public const STATUS_EMPTY= 0;
    public const STATUS_FULL = 1;

    public static $status = [
        self::STATUS_EMPTY => 'Trống',
        self::STATUS_FULL => 'Đầy',
    ];

    //bed type
    public const BED_TYPE_VIP= 3;
    public const STATUS_PREMIUM = 2;
    public const STATUS_NORMAL = 1;

    public static $bedTypes = [
        self::BED_TYPE_VIP => 'Vip',
        self::STATUS_PREMIUM => 'Cao cấp',
        self::STATUS_NORMAL => 'Thường',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'bed_code',
        'name',
        'department_id',
        'bed_type',
        'charge',
        'status',
        'note'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the doctorDepartments
     */
    public function doctorDepartments()
    {
        return $this->belongsTo(DoctorDepartment::class);
    }

    /*
     * Function generate next code
     *
     * @return string
     */
    public static function generateNextCode()
    {
        $maxIdentifierCode = self::withTrashed()->max('bed_code');
        if (empty($maxIdentifierCode)) {
            // Table bed no record
            return sprintf('%s00001', config('const.prefix_code.bed'));
        }
        return sprintf(
            "%s%'.05s",
            config('const.prefix_code.bed'),
            substr($maxIdentifierCode, strlen(config('const.prefix_code.bed'))) + 1
        );
    }
}
