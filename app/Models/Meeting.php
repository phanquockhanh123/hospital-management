<?php

namespace App\Models;


class Meeting extends BaseModel
{
    protected $fillable = [
        'meeting_id',
        'meeting_name',
        'meeting_password',
        'start_url',
        'join_url',
        'user_id',
        'is_active',
        'finished'
    ];
}
