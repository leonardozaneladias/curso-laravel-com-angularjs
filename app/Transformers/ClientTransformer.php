<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 16:59
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;


class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs
        ];
    }

}