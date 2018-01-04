<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VoteProjectRepository;
use App\Entities\Common\VoteProject;
use App\Validators\VoteProjectValidator;

/**
 * Class VoteProjectRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VoteProjectRepositoryEloquent extends BaseRepository implements VoteProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoteProject::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VoteProjectValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
