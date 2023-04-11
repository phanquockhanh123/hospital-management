<?php

namespace App\Models;

class Medical extends BaseModel
{
    //status
    public const STATUS_UNCENSORED = 0;
    public const STATUS_WAITING = 1;
    public const STATUS_CENSORED = 2;

    public static $status = [
        self::STATUS_UNCENSORED => 'Chưa được kiểm duyệt',
        self::STATUS_WAITING => 'Đang chờ kiểm duyệt',
        self::STATUS_CENSORED => 'Đã được kiểm duyệt',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'medical_code',
        'medical_name',
        'department_id',
        'unit',
        'quantity',
        'use',
        'import_price',
        'export_price',
        'amount_day',
        'description',
    ];

    protected $dates = [
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
        $maxIdentifierCode = self::withTrashed()->max('medical_code');
        if (empty($maxIdentifierCode)) {
            // Table bed no record
            return sprintf('%s00001', config('const.prefix_code.medical_code'));
        }
        return sprintf(
            "%s%'.05s",
            config('const.prefix_code.medical_code'),
            substr($maxIdentifierCode, strlen(config('const.prefix_code.medical_code'))) + 1
        );
    }

    /**
     * Get the doctorDepartment
     */
    public function doctorDepartment()
    {
        return $this->belongsTo(DoctorDepartment::class);
    }
}
