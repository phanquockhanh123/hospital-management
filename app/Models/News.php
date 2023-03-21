<?php

namespace App\Models;

class News extends BaseModel
{
    // priorityLevel
    public const LEVEL_OLD = 0;
    public const LEVEL_NORMAL = 1;
    public const LEVEL_NEW = 2;

    public static $priorityLevels = [
        self::LEVEL_OLD => 'Tin cũ',
        self::LEVEL_NORMAL => 'Tin thường',
        self::LEVEL_NEW => 'Tin hot',
    ];

    //status
    public const STATUS_DENIED = 0;
    public const STATUS_PENDING = 1;
    public const STATUS_SUBMITTED = 2;

    public static $status = [
        self::STATUS_DENIED => 'Từ chối đăng bài',
        self::STATUS_PENDING => 'Lưu bản nháp',
        self::STATUS_SUBMITTED => 'Đã đăng bài',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'image',
        'filename',
        'content',
        'source_news',
        'author',
        'priority_level',
        'key_words',
        'status'

    ];

    protected $dates = [
        'submitted_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
