<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Common\VoteRecord;

/**
 * Class VoteRecordTransformer
 * @package namespace App\Transformers;
 */
class VoteRecordTransformer extends TransformerAbstract
{

    /**
     * Transform the VoteRecord entity
     * @param App\Entities\Common\VoteRecord $model
     *
     * @return array
     */
    public function transform(VoteRecord $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
