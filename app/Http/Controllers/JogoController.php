<?php

namespace App\Http\Controllers;

use App\Models\jogo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jogos = jogo::All();

        return(
            $jogos?
            Response()->json(['mensagem'=>'Jogos Cadastrados',
            'Jogos' => $jogos]) :
            'Nenhum jogo cadastrado'
        );


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jogo = $request->all();
    
        $validatedData = Validator::make($jogo, [
            'nome' => 'required',
            'desenvolvedora' => 'required',
            'sinopse' => 'nullable',
            'lancamento' => 'nullable|date',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json([
                'mensagem' => 'Registros faltantes',
                'erros' => $validatedData->errors()
            ], Response::HTTP_NO_CONTENT);
        }
    
        $enviaDados = Jogo::create($jogo);
    
        if ($enviaDados) {
            return response()->json([
                'mensagem' => 'Registro cadastrado com sucesso',
                'jogo' => $enviaDados
            ], Response::HTTP_CREATED); 
        } else {
            return response()->json([
                'mensagem' => 'Erro ao cadastrar registro'
            ], Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(jogo $jogo)
    {
        $id = $jogo; 
    
        $findJogo = Jogo::find($jogo);
    
        return(
            $findJogo?
            Response()->json(['mensagem'=>'Jogo Encontrado',
            'Jogo' => $findJogo]) :
            'Nenhum jogo encontrado'
        );
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jogo $jogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jogo $jogo)
    {
        //
    }
}
