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
    public function show($id)
    { 
        $jogo = Jogo::find($id);
    
        return(
            $jogo?
            Response()->json(['mensagem'=>'Jogo Encontrado',
            'Jogo' => $jogo]) :
            'Nenhum jogo encontrado'
        );
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
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
        
        $jogoAtt = Jogo::find($id);
        
        if(!$jogoAtt){ 
        return response()->json([
            'message' => 'jogo não encontrado'
        ], 404);
        }
        
        return(
        $jogoAtt->update($jogo)? 
           response()->json([
                'mensagem' => 'Registro atualizado com sucesso',
                'jogo' => $jogoAtt
            ], 200) 
        :
            response()->json([
                'mensagem' => 'Erro ao atualizar registro'
            ], Response::HTTP_INTERNAL_SERVER_ERROR)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jogo = Jogo::find($id);

        if(!$jogo){ 
        return response()->json([
            'message' => 'jogo não encontrado'
        ], 404);
        }
    

        return(
            $jogo->delete()? 
                response()->json([
                    'success' => true,
                    'message' => 'Jogo deletado com sucesso'
                ], 200)
            :
            response()->json([
                'success' => false,
                'message' => 'Erro ao deletar o jogo'
            ], 500)
        );
    }
}
