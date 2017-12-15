<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\VotePerson;


class Person extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'content',
        'avatar',
        'vote_id'
    ];
    protected $table = 'persion';
    public $timestamps = false;

    public function getSorceAttribute()
    {
        return VotePerson::where('user_id',$this->id)->first()->sorce;
    }


}

