<?php

namespace App\Models;

class Attendance extends BaseModel
{
      /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
        'hour_worked'
    ];

    protected $dates = [
        'login_time',
        'logout_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
