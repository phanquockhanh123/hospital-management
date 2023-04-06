<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'service_code',
        'service_name',
        'all_price',
        'discount',
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
        $maxIdentifierCode = self::withTrashed()->max('service_code');
        if (empty($maxIdentifierCode)) {
            // Table bed no record
            return sprintf('%s00001', config('const.prefix_code.service'));
        }
        return sprintf(
            "%s%'.05s",
            config('const.prefix_code.service'),
            substr($maxIdentifierCode, strlen(config('const.prefix_code.service'))) + 1
        );
    }
}
