<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 23/07/16
 * Time: 16:59
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;


class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'Members'
    ];

    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'project' => $project->name,
            'client' => $project->client_id,
            'owner' => $project->owner_id,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date
        ];
    }

    public function includeMembers(Project $project)
    {

        return $this->collection($project->members, new ProjectMemberTransformer());

    }

}