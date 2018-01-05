<?php

namespace App\Entities\Common;


use App\Observers\VoteRecordObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteRecord extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    const UPDATED_AT = null;

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static function boot()
    {
        parent::boot();
        static::observe(new VoteRecordObserver());
    }


    public function voteItem()
    {
        return $this->belongsTo(VoteItem::class,'vote_item_id');
    }
}
