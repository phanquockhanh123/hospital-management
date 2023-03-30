<?php

namespace App\Models;

class Chat extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'body',
        'send_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     /**
     * Get the user
     */
    public function sendBy()
    {
        return $this->belongsTo(User::class);
    }
}
