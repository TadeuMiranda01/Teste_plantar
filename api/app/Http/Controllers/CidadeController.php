<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    public function __construct( Cidade $cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->cidade->with('grupo')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->cidade->rules());
        

        $cidade = $this->cidade->create([
            'nome' => $request->nome,
            'grupo_id' => $request->grupo_id,
            'idade' =>  $request->idade,
            'estado' => $request->estado            
        ]);

        return response()->json($cidade, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cidade = $this->cidade->with('grupo')->find($id);
        if($cidade === null){
            return response()->json(['erro' => 'Recurso Pesquisado não existe'], 404);
        }
        return response()->json($cidade, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCidadeRequest  $request
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cidade = $this->cidade->find($id);

        if($cidade === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($cidade->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
           $request->validate($cidade->rules());
        }

        $cidade->fill($request->all());
        $cidade->save();

        return response()->json($cidade, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cidade = $this->cidade->find($id);

        if($cidade === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }       

        $cidade->delete();
        return response()->json(['msg' => 'A cidade foi removida com sucesso!'], 200);
    }
}
