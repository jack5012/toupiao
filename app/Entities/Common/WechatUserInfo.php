<?php

namespace App\Entities\Common;

use Illuminate\Database\Eloquent\Model;


class WechatUserInfo extends Model
{
    protected $fillable = [];

    public $timestamps = false;

    protected $table = 'wechat_user_info';

}
