<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Common\VoteProject;

/**
 * Class VoteProjectTransformer
 * @package namespace App\Transformers;
 */
class VoteProjectTransformer extends TransformerAbstract
{

    /**
     * Transform the VoteProject entity
     * @param App\Entities\Common\VoteProject $model
     *
     * @return array
     */
    public function transform(VoteProject $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
