<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Entities\ProjectNotes;

/**
 * Class ProjectNotesRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectNotesRepositoryEloquent extends BaseRepository implements ProjectNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNotes::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter()
    {
        return ProjectNotePresenter::class;
    }
}
