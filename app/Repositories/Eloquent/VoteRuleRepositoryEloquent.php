<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VoteRuleRepository;
use App\Entities\Common\VoteRule;
use App\Validators\VoteRuleValidator;

/**
 * Class VoteRuleRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VoteRuleRepositoryEloquent extends BaseRepository implements VoteRuleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoteRule::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
