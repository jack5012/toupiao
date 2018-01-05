<?php

namespace App\Presenters;

use App\Transformers\VoteRecordTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VoteRecordPresenter
 *
 * @package namespace App\Presenters;
 */
class VoteRecordPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VoteRecordTransformer();
    }
}
