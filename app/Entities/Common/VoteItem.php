<?php

namespace App\Entities\Common;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteItem extends Model implements Transformable
{
    use TransformableTrait;
    const UNREVIEW = 0;
    const REVIEWD = 1;
    const LOCKED = 2;
    public static $_status = [self::UNREVIEW=>'未审核',self::REVIEWD=>'审核通过',self::LOCKED=>'锁定'];
    protected $fillable = [];

    public function voteProject()
    {
        return $this->belongsTo(VoteProject::class,'vote_projects_id');
    }

    public function voteRecord()
    {
        return $this->hasMany(VoteRecord::class,'vote_item_id');
    }

    public function setImagesAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['images'] = json_encode($images);
        }
    }

    public function getImagesAttribute($images)
    {
        return json_decode($images, true);
    }

}
