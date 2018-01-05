<?php

namespace App\Entities\Common;

use App\Observers\VoteProjectObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteProject extends Model implements Transformable
{
    const CLOSED = 0;
    const OPEND = 1;

    use TransformableTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [];


    public static function boot()
    {
        parent::boot();
        static::observe(new VoteProjectObserver());
    }


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
