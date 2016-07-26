<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 16:59
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectNotes;
use League\Fractal\TransformerAbstract;


class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNotes $projectNote)
    {
        return [
            'id' => $projectNote->id,
            'project_id' => $projectNote->project_id,
            'title' => $projectNote->title,
            'note' => $projectNote->note
        ];
    }

}