<?php

namespace App\Listeners;

use App\Entities\Common\WechatUserInfo;
use \Overtrue\LaravelWechat\Events\WeChatUserAuthorized;


class WeChatUserAuthorizedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WeChatUserAuthorized  $event
     * @return void
     */
    public function handle(WeChatUserAuthorized $event)
    {
        if($event->isNewSession()){
            $this->createOrUpdate($event->user);
        }
    }
    private function createOrUpdate($user){
        $wechat_user = WechatUserInfo::where('openid',$user->id)->first();
        if(!$wechat_user) {
            $wechat_user = new WechatUserInfo();
            $wechat_user->openid = $user->id;
            $wechat_user->nickname = $user->nickname;
            $wechat_user->sex = $user->sex;
            $wechat_user->province = $user->province;
            $wechat_user->city = $user->city;
            $wechat_user->country = $user->country;
            $wechat_user->headimgurl = $user->headimgurl;
            $wechat_user->privilege = $user->privilege;
            $wechat_user->unionid = $user->unionid;
            $wechat_user->save();
        }
    }
}
