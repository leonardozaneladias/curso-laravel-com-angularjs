<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 17:08
 */

namespace CodeProject\Presenters;


use CodeProject\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;


class ClientPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        // TODO: Implement getTransformer() method.
        return new ClientTransformer();
    }


}