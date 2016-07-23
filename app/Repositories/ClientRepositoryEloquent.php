<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 18/06/16
 * Time: 21:49
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    /**
     * @return Client
     */
    public function model()
    {
        return Client::class;
    }
    
}