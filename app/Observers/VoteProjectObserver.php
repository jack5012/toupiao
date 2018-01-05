<?php

namespace App\Observers;

use App\Entities\Common\VoteProject;

class VoteProjectObserver
{

    public function __construct(){

    }

    public function deleted(VoteProject $voteProject)
    {
        $voteProject->voteRecord()->delete();   //先删投票记录
        $voteProject->voteItem()->delete();     //再删报名记录
    }

}
