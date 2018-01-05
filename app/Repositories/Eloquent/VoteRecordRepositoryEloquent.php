<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VoteRecordRepository;
use App\Entities\Common\VoteRecord;
use App\Validators\VoteRecordValidator;

/**
 * Class VoteRecordRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VoteRecordRepositoryEloquent extends BaseRepository implements VoteRecordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoteRecord::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VoteRecordValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
