<?php

namespace App\Observers;

use App\Entities\Common\VoteItem;

class VoteItemObserver
{

    public function __construct(){

    }

    public function creating(VoteItem $voteItem)
    {
        $no = VoteItem::where('vote_projects_id',$voteItem->vote_projects_id)->max('item_no');
        $voteItem->item_no = $no+ 1;
    }

    public function created(VoteItem $voteItem)
    {
        $voteItem->voteProject->involved += 1;
        $voteItem->voteProject->save();
    }

    public function saving(VoteItem $voteItem)
    {
        if($voteItem->isDirty('images')){
            $voteItem->main_image = $voteItem->images[0];
        }

    }

    /*public function saved(VoteItem $voteItem)
    {
        if($voteItem->isDirty('voted')){
            $voteItem->voteProject->voted += 1;
            $voteItem->voteProject->save();
        }

    }*/

    public function deleted(VoteItem $voteItem)
    {
        /*$voteItem->voteProject->involved -= 1;  //从投票主题参与者数量减1
        $voteItem->voteProject->voted -= $voteItem->voted;  //从投票主题中删除该参与者投票总数
        $voteItem->voteProject->save();*/

        $voteItem->voteRecord()->delete();   //删除所有该参与者的投票记录
    }

}
