<?php

namespace App\Entities\Common;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteRule extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
