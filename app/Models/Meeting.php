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

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
