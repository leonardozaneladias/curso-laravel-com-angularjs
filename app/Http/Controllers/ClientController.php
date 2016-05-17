<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Client;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Client::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Client::find($id);
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

        $input = $request->all();
        $data = Client::findOrFail($id);
        $data->update($input);
        return $data;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Client::find($id);
        if($data):
            $data->delete();
            $msg = ['error'=>'0','msg'=>'Cliente deletado com sucesso!'];
            echo json_encode($msg);
        else:
            $msg = ['error'=>'1','msg'=>'Erro ao deletar, cliente não encontrado!'];
            echo json_encode($msg);
        endif;


        /*
        if(Client::find($id)->delete()):
            $msg = ['error'=>'0','msg'=>'Cliente deletado com sucesso!',];
            echo json_encode($msg);
        else:
            $msg = ['error'=>'1','msg'=>'Erro ao deletar Cliente!',];
            echo json_encode($msg);
        endif;
        */

    }
}
