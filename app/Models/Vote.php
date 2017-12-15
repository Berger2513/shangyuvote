<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Vote extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'title',
        'content',
        'status',
        'create_time',
        'end_time',
        'max_num'
    ];
    protected $table = 'vote';
    public $timestamps = false;
}
