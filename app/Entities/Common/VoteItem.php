<?php

namespace App\Entities\Common;


use App\Observers\VoteItemObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VoteItem extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    const UNREVIEW = 0;
    const REVIEWD = 1;
    const LOCKED = 2;
    public static $_status = [self::UNREVIEW=>'未审核',self::REVIEWD=>'审核通过',self::LOCKED=>'锁定'];

    protected $dates = ['deleted_at'];
    protected $fillable = [];

    public static function boot()
    {
        parent::boot();
        static::observe(new VoteItemObserver());
    }

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

    public function scopeActive($query)
    {
        return $query->where('status', self::REVIEWD);
    }

    public function scopeMyitem($query)
    {
        return $query->where('openid', session('wechat.oauth_user')->getId());
    }



}
