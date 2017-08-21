<?php

namespace App\Presenters;

use App\Transformers\RouteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoutePresenter
 *
 * @package namespace App\Presenters;
 */
class RoutePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RouteTransformer();
    }
}
