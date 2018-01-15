<?php

namespace App\Observers;

use App\Entities\Common\VoteRecord;

class VoteRecordObserver
{

    public function __construct(){

    }

    public function created(VoteRecord $voteRecord)
    {
        /*if($voteRecord->isDirty('voted')){
            $voteRecord->voteItem->voted += 1;
            $voteRecord->voteItem->save();
        }*/
        $voteRecord->voteItem->voted += 1;
        $voteRecord->voteItem->save();
        $voteRecord->voteItem->voteProject->voted  += 1;
        $voteRecord->voteItem->voteProject->save();
    }

    public function deleted(VoteRecord $voteRecord)
    {
        /*$voteRecord->voteItem->voted -= 1;
        $voteRecord->voteItem->save();*/
    }
}
