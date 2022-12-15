<?php

namespace App\Http\Controllers;

use App\Models\Desconto;
use Illuminate\Http\Request;

class DescontoController extends Controller
{

    public function __construct( Desconto $desconto)
    {
        $this->desconto = $desconto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->desconto->with('produto')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDescontoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->desconto->rules());

        $desconto = $this->desconto->create([
            'produto_id' => $request->produto_id,
            'desconto' => $request->desconto
        ]);

        return response()->json($desconto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desconto  $desconto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desconto = $this->desconto->with('produto')->find($id);
        if($desconto === null){
            return response()->json(['erro' => 'Recurso Pesquisado não existe'], 404);
        }
        return response()->json($desconto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDescontoRequest  $request
     * @param  \App\Models\Desconto  $desconto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $desconto = $this->produto->find($id);

        if($desconto === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($desconto->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
           $request->validate($desconto->rules());
        }

        $desconto->fill($request->all());
        $desconto->save();

        return response()->json($desconto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desconto  $desconto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desconto = $this->produto->find($id);

        if($desconto === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }       

        $desconto->delete();
        return response()->json(['msg' => 'A desconto foi removida com sucesso!'], 200);
    }
}
