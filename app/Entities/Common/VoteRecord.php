<?php

namespace App\Entities\Common;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteRecord extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    public function voteItem()
    {
        return $this->belongsTo(VoteItem::class,'vote_item_id');
    }
}
