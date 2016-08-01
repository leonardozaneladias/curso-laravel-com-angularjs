<?php

namespace CodeProject\Http\Controllers;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    private  $repository;
    private  $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->findWhere(['owner_id' => Authorizer::getResourceOwnerId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkProjectPermissions($id) == false){
            return ['error' => 'Access forbidden'];
        }

        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Erro, não foi possivel selecionar o projeto.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' => 'Erro, projeto não encontrado.'];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }


        try {
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' =>  'Erro! não foi possivel atualizar seu Projeto!'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' =>  'Erro! Projeto não pode ser atualizado porque não existe!'];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }

        return $this->service->destroy($id);

    }



    /*
     * PRIVATES FUNCTIONS
     */

    private function checkProjectOwner($projectId)
    {

        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);

    }

    private function checkProjectMember($projectId)
    {

        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);

    }

    private  function checkProjectPermissions($projectId){

        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }

        return false;

    }
}
