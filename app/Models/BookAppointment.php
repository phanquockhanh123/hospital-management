<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends BaseModel
{

     //status
     public const STATUS_DENIED = 0;
     public const STATUS_PENDING = 1;
     public const STATUS_ACCEPTED = 2;
 
     public static $status = [
         self::STATUS_PENDING => 'Đang chờ',
         self::STATUS_ACCEPTED => 'Chấp nhận ',
         self::STATUS_DENIED => 'Từ chối',
     ];

    protected $fillable =[
        'fullname',
        'email',
        'phone',
        'reason',
        'experted_time',
        'status'
    ];

    protected $dates = [
        'experted_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
