<?php

namespace App\Presenters;

use App\Transformers\VoteProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VoteProjectPresenter
 *
 * @package namespace App\Presenters;
 */
class VoteProjectPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VoteProjectTransformer();
    }
}
