<?php

namespace App\Presenters;

use App\Transformers\VoteItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VoteItemPresenter
 *
 * @package namespace App\Presenters;
 */
class VoteItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VoteItemTransformer();
    }
}
