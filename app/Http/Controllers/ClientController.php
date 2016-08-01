<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private  $repository;
    private  $service;

    public function __construct(ClientRepository $repository, ClientService $service)
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
        return $this->repository->all();
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

        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' => 'Erro, Cliente não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' => 'Erro, não foi possivel selecionar o Cliente.'];
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

        try {
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'msg' =>  'Erro! Cliente não pode ser atualizado porque não existe!'];
        } catch (\Exception $e) {
            return ['error'=>true, 'msg' =>  'Erro! não foi possivel atualizar o Cliente!'];
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
        return $this->service->destroy($id);

    }
}
