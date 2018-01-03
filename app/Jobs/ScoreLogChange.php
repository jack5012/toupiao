<?php

namespace App\Jobs;

use App\Entities\Common\WxScoreLog;
use App\Entities\Common\WxUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWeChat\Facade as EasyWeChat;

class ScoreLogChange implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries =2;

    protected $scoreLog;

    public function __construct(WxScoreLog $scoreLog)
    {
        $this->scoreLog = $scoreLog;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user =  WxUser::find($this->scoreLog->user_id);

        if($this->scoreLog->type){
            $user->score = $user->score - $this->scoreLog->value;;
        }else{
            $user->score = $user->score + $this->scoreLog->value;;
        }
        $user->save();
        try {
            $app = EasyWeChat::officialAccount();
            $message = new Text($this->scoreLog->mark);
            $app->customer_service->message($message)->to($this->scoreLog->wxid)->send();
        } catch (\Exception $e){
            Log::info('积分变化通知异常:'.$e->getMessage());
            return false;
        }
    }
}
