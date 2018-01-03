<?php

namespace App\Observers;

use App\Entities\Common\WxScoreLog;
use App\Entities\Common\WxUser;
use App\Jobs\ScoreLogChange;
use Queue;
use EasyWeChat\Kernel\Messages\Text;
use Overtrue\LaravelWeChat\Facade as EasyWeChat;

class ScoreLogObserver
{

    public function __construct(){

    }
    public function created(WxScoreLog $scoreLog)
    {

        ScoreLogChange::dispatch($scoreLog);

        /*$user =  WxUser::find($scoreLog->user_id);
        if($scoreLog->type){
            $user->score = $user->score - $scoreLog->value;;
        }else{
            $user->score = $user->score + $scoreLog->value;;
        }
        $user->save();
        $app = EasyWeChat::officialAccount();
        $message = new Text($scoreLog['mark']);
        $result = $app->customer_service->message($message)->to($scoreLog['wxid'])->send();*/
    }
}
