<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VoteItemRepository;
use App\Entities\Common\VoteItem;
use App\Validators\VoteItemValidator;

/**
 * Class VoteItemRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VoteItemRepositoryEloquent extends BaseRepository implements VoteItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoteItem::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VoteItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
