<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VotePerson extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'vote_id',
        'user_id',
        'sorce'
    ];
    protected $table = 'vote_person';
    public $timestamps = false;
}
