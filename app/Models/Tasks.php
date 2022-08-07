<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public const STATUS_PLANED = 'PLANED';
    public const STATUS_PROCESS = 'PROCESS';
    public const STATUS_SUCCESS = 'SUCCESS';

    protected $fillable = [
        'user_id',
        'task_name',
        'description',
        'status_tag_value',
        'image_path'
    ];
}
