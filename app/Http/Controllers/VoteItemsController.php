<?php

namespace App\Http\Controllers;

use App\Entities\Common\VoteItem;
use App\Entities\Common\VoteProject;
use App\Entities\Common\VoteRecord;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Carbon;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VoteItemCreateRequest;
use App\Http\Requests\VoteItemUpdateRequest;
use App\Contracts\Repositories\VoteItemRepository;
use App\Validators\VoteItemValidator;


class VoteItemsController extends Controller
{

    /**
     * @var VoteItemRepository
     */
    protected $repository;

    /**
     * @var VoteItemValidator
     */
    protected $validator;

    public function __construct(VoteItemRepository $repository, VoteItemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    public function show($id)
    {
        $voteItem = $this->repository->with('voteProject')->find($id);

        $prive_item = VoteItem::where('voted','>',$voteItem->voted)->where('vote_projects_id',$voteItem->vote_projects_id)->active()->get();

        if($prive_item->isEmpty()){
            $counta =1;
            $diff =0;
        }else{
            $counta = $prive_item->count();
            $diff = $prive_item->last()->voted - $voteItem->voted;
        }
        return view('vote-items.show', compact('voteItem','counta','diff'));
    }



    public function vote(VoteItemUpdateRequest $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $openid = session('wechat.oauth_user')->getId();
        $itemID = $request->input('id');

        $voteItem = VoteItem::find($itemID);

        $voteRecord = $voteItem->voteRecord()->where(function ($query) use ($openid) {
            $query->where('openid', '=', $openid);
            $query->whereDate('created_at',Carbon::now()->toDateString());
        })->get();

        if($voteRecord->isNotEmpty()){
            return response()->json([
                'error'   => true,
                'message' => '不能重复投票'
            ]);
        }

        $count = VoteProject::find($voteItem->vote_projects_id)->voteRecord()->where(function ($query) use ($openid) {
            $query->where('vote_records.openid', '=', $openid);
            $query->whereDate('vote_records.created_at',Carbon::now()->toDateString());
        })->count();

        if($count >= 3){
            return response()->json([
                'error'   => true,
                'message' => '你的投票次数已用完'
            ]);
        }

        $voteRecord = new VoteRecord();
        $voteRecord->openid = $openid;
        $voteRecord->vote_item_id = $itemID;
        $voteRecord->save();

        $response = [
            'message' => '投票成功,谢谢参与',
            'data'    => '',
        ];
        return response()->json($response);

    }

}
