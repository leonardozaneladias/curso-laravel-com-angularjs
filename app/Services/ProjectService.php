<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 22/07/16
 * Time: 21:15
 */

namespace CodeProject\Services;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    protected $repository;
    protected $validator;
    private $filesystem;
    private $storage;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

        try {
            $this->repository->delete($id);
            return ['success'=>true, 'msg' => 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true,'msg' =>  'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true,'msg' =>  'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true,'msg' =>  'Ocorreu algum erro ao excluir o projeto.'];
        }

    }


    public function createFile(array $data)
    {

        $project = $this->repository->skipPresenter()->find($data['project_id']);;
        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id .".". $data['extension'], $this->filesystem->get($data['file']));


    }

}


