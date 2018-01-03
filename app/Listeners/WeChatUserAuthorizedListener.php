<?php

namespace App\Listeners;

use App\Entities\Common\WxUser;
use App\Entities\Common\UserAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        if($event->isNewSession() || !Auth::guard('wxuser')->check()){
            $this->createOrUpdate();
        }
    }
    private function createOrUpdate(){
        $user = UserAuth::where('identifier',session('wechat.oauth_user')->id)->whereIn('identity_type', ['weixin'])->first();
        if($user){
            $user_id = $user->user_id;
        }else{
            $user = new WxUser();
            $user->save();
            UserAuth::create([
                'user_id' => $user->id,
                'identity_type' => 'weixin',
                'identifier' => session('wechat.oauth_user')->id,
                'credential' => '',
                'verified' => 1
            ]);
            $user_id = $user->id;
        }
        Auth::guard('wxuser')->loginUsingId($user_id);
    }
}
