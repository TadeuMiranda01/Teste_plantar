<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public function __construct( Grupo $grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json($this->grupo->with('cidade')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGrupoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->grupo->rules());

        $grupo = $this->grupo->create([
            'campanha_id' => $request->campanha_id,
            'nome_grupo' => $request->nome_grupo
        ]);

        return response()->json($grupo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = $this->grupo->with('cidades')->find($id);
        if($grupo === null){
            return response()->json(['erro' => 'Recurso Pesquisado não existe'], 404);
        }
        return response()->json($grupo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGrupoRequest  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grupo = $this->grupo->find($id);

        if($grupo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($grupo->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
           $request->validate($grupo->rules());
        }

        $grupo->fill($request->all());
        $grupo->save();

        return response()->json($grupo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = $this->grupo->find($id);

        if($grupo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }       

        $grupo->delete();
        return response()->json(['msg' => 'A grupo foi removida com sucesso!'], 200);
    }
}
