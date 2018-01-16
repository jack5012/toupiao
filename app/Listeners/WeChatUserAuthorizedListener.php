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
            $this->createOrUpdate($event->user);
    }
    private function createOrUpdate($user){
        $wechat_user = WechatUserInfo::where('openid',$user->id)->first();
        if(!$wechat_user) {
            $wechat_user = new WechatUserInfo();
            $info = $user->getOriginal();
            $wechat_user->openid = $user->id;
            $wechat_user->nickname = $user->getNickname();
            if($info){
                $wechat_user->sex = $info['sex'];
                $wechat_user->province = $info['province'];
                $wechat_user->city =  $info['city'];
                $wechat_user->country = $info['country'];
                $wechat_user->privilege = \json_encode($info['privilege']);
            }
            $wechat_user->headimgurl = $user->getAvatar();
            $wechat_user->save();
        }
    }
}
