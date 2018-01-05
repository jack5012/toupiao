<?php

namespace App\Entities\Common;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteProject extends Model implements Transformable
{
    const CLOSED = 0;
    const OPEND = 1;

    use TransformableTrait;

    protected $fillable = [];

    public function voteItem()
    {
        return $this->hasMany(VoteItem::class, 'vote_projects_id');
    }

    public function voteRecord()
    {
        return $this->hasManyThrough(VoteRecord::class, VoteItem::class, 'vote_projects_id', 'vote_item_id');
    }

    public function setSlideAttribute($slide)
    {
        if (is_array($slide)) {
            $this->attributes['slide'] = json_encode($slide);
        }
    }

    public function getSlideAttribute($slide)
    {
        return json_decode($slide, true);
    }

}
