<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 22/07/16
 * Time: 21:15
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNotesRepository;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectNotesValidator;
use CodeProject\Validators\ProjectTaskValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function destroy($id)
    {
        try{
            $this->repository->delete($id);
            return [
                'delete' => true
            ];
        }catch (ModelNotFoundException $e){
            return [
                'error' => true,
                'message' => 'Erro ao deletar, tarefa não econtrada!'
            ];
        }

    }

}


