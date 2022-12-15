<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function __construct( Campanha $campanha)
    {
        $this->campanha = $campanha;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->campanha->with('grupo','produto')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCampanhaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->campanha->rules());
        

        $campanha = $this->campanha->create([
            'grupo_id' => $request->grupo_id,
            'nome_campanha' => $request->nome_campanha
        ]);

        return response()->json($campanha, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campanha  $campanha
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campanha = $this->campanha->with('grupo')->find($id);
        if($campanha === null){
            return response()->json(['erro' => 'Recurso Pesquisado não existe'], 404);
        }
        return response()->json($campanha, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCampanhaRequest  $request
     * @param  \App\Models\Campanha  $campanha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campanha = $this->campanha->find($id);

        if($campanha === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($campanha->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
           $request->validate($campanha->rules());
        }

        $campanha->fill($request->all());
        $campanha->save();

        return response()->json($campanha, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campanha  $campanha
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campanha = $this->campanha->find($id);

        if($campanha === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }       

        $campanha->delete();
        return response()->json(['msg' => 'A campanha foi removida com sucesso!'], 200);
    }
}
