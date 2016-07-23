<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 16:59
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;


class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'member_id' => $member->id
        ];
    }

}