<?php

namespace App\Listeners;


use App\Entities\Common\WxMaterial;
use App\Events\WechatClick;
use App\Entities\Common\WxQrcode;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Overtrue\LaravelWeChat\Facade as EasyWeChat;
use Illuminate\Support\Facades\Storage;
use EasyWeChat\Kernel\Messages\Media;
use Illuminate\Contracts\Queue\ShouldQueue;

class WechatClickSetSencePic implements ShouldQueue
{


    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  WeChatUserAuthorized  $event
     * @return void
     */
    public function handle(WechatClick $event)
    {
        $app = EasyWeChat::officialAccount();
        if($event->message['EventKey'] && 'getQrcodePic'==$event->message['EventKey']){
            $wxid = $event->message['FromUserName'];
            /*if(Cache::has($wxid)){
                return '二维码生成中,请耐心等待';
            }
            Cache::add($wxid, 1, 1);*/
            $old_material = WxMaterial::where('wxid', $wxid)->first();
            $material_media_id = '';
            if($old_material){
                if($old_material->wx_created_at + 3*24*3600-6000 < time()){
                    $new_material = $app->media->uploadImage(storage_path($old_material->local));
                    $old_material->fill(['media_id'=>$new_material['media_id'],'wx_created_at'=>$new_material['created_at']]);
                    $old_material->save();
                    $material_media_id = $new_material['media_id'];
                }else{
                    $material_media_id = $old_material['media_id'];
                }
            }else{
                $qrcode= WxQrcode::where('wxid', $wxid)->first();
                if(!$qrcode){
                    $keyword = 'qr_relation_'.$wxid;
                    $create_qrcode = $app->qrcode->forever($keyword);
                    //$create_qrcode = $app->qrcode->temporary($keyword,6 * 24 * 3600);
                    $url = $app->qrcode->url($create_qrcode['ticket']);
                    $content = file_get_contents($url); // 得到二进制图片内容
                    $local = 'public/wx_qrcodes/'.$wxid.'.jpg';
                    Storage::put($local, $content);
                    $qrcode = WxQrcode::create(['wxid'=>$wxid,'keyword'=>$keyword,'ticket'=>$create_qrcode['ticket'],'url'=>$create_qrcode['url'],'local'=>'app/'.$local]);
                }
                $img = Image::make(storage_path('app/public/a.jpg'));  //背景底图
                $img->insert(Image::make(storage_path($qrcode['local']))->resize(150, 150), 'top-right', 82, 135);
                $local = 'app/public/wx_material/'.$wxid.'.jpg';
                $img->save(storage_path($local));
                $new_material = $app->media->uploadImage(storage_path($local));
                WxMaterial::create(['wxid'=>$wxid,'media_id'=>$new_material['media_id'],'wx_created_at'=>$new_material['created_at'],'local'=>$local]);
                $material_media_id = $new_material['media_id'];
            }
            $media = new Media($material_media_id, 'image');
            $app->customer_service->message($media)->to($wxid)->send();
            //Cache::forget($wxid);
            //return $material_media_id;
        }
    }
}
