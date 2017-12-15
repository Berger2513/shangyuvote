<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class VotePoler extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'vote_id',
        'phone',
        'poler_id',
        'vote_date',
    ];
    protected $table = 'vote_poler';
    public $timestamps = false;


}
