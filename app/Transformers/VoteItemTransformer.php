<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Common\VoteItem;

/**
 * Class VoteItemTransformer
 * @package namespace App\Transformers;
 */
class VoteItemTransformer extends TransformerAbstract
{

    /**
     * Transform the VoteItem entity
     * @param App\Entities\Common\VoteItem $model
     *
     * @return array
     */
    public function transform(VoteItem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
