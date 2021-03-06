<?php

namespace App\Http\Controllers;

use App\Entities\Common\VoteItem;
use App\Entities\Common\VoteProject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class VoteProjectsController extends Controller
{


    protected $repository;


    public function __construct()
    {

    }


    public function ranking($id)
    {
        $voteProject = VoteProject::active()->findOrFail($id);
        $voteItems =  $voteProject->voteItem()->active()->orderBy('voted','desc')->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'voteItems' => $voteItems->toJson(),
            ]);
        }
        return view('vote-projects.ranking', compact('voteProject','voteItems'));
    }

    public function search(Request $request,$id)
    {
        $voteProject = VoteProject::active()->findOrFail($id);
        $voteItems=[];
        if (request()->post()) {
            $this->validate($request, [
                'search_txt' => 'required',
            ]);
            $voteItems =  $voteProject->voteItem()->active()->where(
                function($query)use($request){
                    $search =  $request->input('search_txt');
                    $query->where('item_no', '=', $search);
                    $query->orWhere('name', 'like', '%'.$search.'%');
                    $query->orderBy('created_at', 'desc');
                }
            )->get();
        }
        return view('vote-projects.search', compact('voteProject','voteItems'));
    }

    public function index(Request $request,$id)
    {
        $voteProject = VoteProject::with(['voteItem' => function ($query) {
            $query->myitem();
        }])->active()->findOrFail($id);

        $sortBy = $request->input('sortBy');
        $voteItems = $voteProject->voteItem()->active()
            ->when($sortBy, function ($query) use ($sortBy) {
                if($sortBy=='vote'){
                    return $query->orderBy('voted','desc');
                }elseif ($sortBy=='time'){
                    return $query->orderBy('created_at','desc');
                }else{
                    return $query->orderBy('id','asc');
                }
            }, function ($query) {
                return $query->orderBy('id','asc');
            })->paginate(10);
        if (request()->ajax()  || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'voteItems' => $voteItems->toJson(),
            ]);
        }
        if(request()->isMethod('GET')){
            $voteProject->visitd += 1;
            $voteProject->save();
        }
        return view('vote-projects.index', compact('voteProject','voteItems'));
    }


    public function info($id)
    {
        $voteProject = VoteProject::active()->findOrFail($id);
        return view('vote-projects.info', compact('voteProject'));
    }

    public function register(Request $request, $id)
    {

        $voteProject = VoteProject::with(['voteItem' => function ($query) {
            $query->myitem();
        }])->active()->findOrFail($id);

        if (request()->ajax()) {
            if($voteProject->voteItem->isNotEmpty() && $voteProject->voteItem->first()->status != VoteItem::UNREVIEW){
                return response()->json([
                    'error'   => true,
                    'message' => '不能重复参加'
                ]);
            }
            $this->validate($request, [
                'images' => 'required',
                'name' => 'required',
                'desc' => 'required',
            ]);
            $files = $request->file('images');
            $filePath =[];
            foreach ($files as $key => $value) {
                // 判断图片上传中是否出错
                if (!$value->isValid()) {
                    return response()->json([
                        'success'   => true,
                        'message' => '上传图片出错，请重试！'
                    ]);
                }
                if(!empty($value)){//此处防止没有多文件上传的情况
                    $allowed_extensions = ["png", "jpg", "gif","jpeg"];
                    if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
                        return response()->json([
                            'success'   => true,
                            'message' => '您只能上传PNG、JPG或GIF格式的图片！'
                        ]);
                    }
                    $destinationPath = '/images/'.date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                    $extension = $value->getClientOriginalExtension();   // 上传文件后缀
                    $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名
                    $value->move(public_path('uploads').$destinationPath, $fileName); // 保存图片
                    $filePath[] = $destinationPath.'/'.$fileName;
                }
            }
            if($voteProject->voteItem->isNotEmpty()){
                $voteItem = $voteProject->voteItem->first();
                $voteItem->main_image= current($filePath);
                $voteItem->images= $filePath;
                $voteItem->name= $request->post('name');
                $voteItem->desc= $request->post('desc');
                $voteItem->status= VoteItem::REVIEWING;
                $voteItem->save();
                return response()->json([
                    'success'   => true,
                    'message' => '修改成功,等待审核'
                ]);
            }else{
                $voteItem =  new VoteItem();
                $voteItem->openid =session('wechat.oauth_user')->getId();;
                $voteItem->main_image= current($filePath);
                $voteItem->images= $filePath;
                $voteItem->name= $request->post('name');
                $voteItem->desc= $request->post('desc');;
                $voteProject->voteItem()->save($voteItem);
                return response()->json([
                    'success'   => true,
                    'message' => '参加成功,等待审核'
                ]);
            }

        }

        if($voteProject->voteItem->isNotEmpty()){
            $voteItem = $voteProject->voteItem->first();
            if($voteItem->status ==VoteItem::REVIEWING){
                //审核中
                $status ='审核中';
                return view('vote-projects.register.reviewing', compact('voteProject','status','voteItem'));

            }elseif($voteItem->status ==VoteItem::REVIEWD){
                //审核通过
                $status ='审核通过';
                return view('vote-projects.register.reviewing', compact('voteProject','status','voteItem'));

            }elseif($voteItem->status ==VoteItem::UNREVIEW){
                //未通过
                $status ='审核未通过';
                return view('vote-projects.register.unreview', compact('voteProject','status','voteItem'));

            }elseif($voteItem->status ==VoteItem::LOCKED){
                //锁定
                $status ='锁定';
                return view('vote-projects.register.reviewing', compact('voteProject','status','voteItem'));

            }
        }
        $status = '还未报名';
        return view('vote-projects.register.register', compact('voteProject','status'));
    }


}
