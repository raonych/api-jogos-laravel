<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\filmes;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FilmesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmes = filmes::All();

        return(
            $filmes?
            Response()->json(['mensagem'=>'filmes Cadastrados',
            'filmes' => $filmes]) :
            'Nenhum filmes cadastrado'
        );


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filmes = $request->all();
    
        $validatedData = Validator::make($filmes, [
            'nome' => 'required',
            'genero' => 'required',
            'sinopse' => 'nullable',
            'lancamento' => 'nullable|date',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json([
                'mensagem' => 'Registros faltantes',
                'erros' => $validatedData->errors()
            ], Response::HTTP_NO_CONTENT);
        }
    
        $enviaDados = filmes::create($filmes);
    
        if ($enviaDados) {
            return response()->json([
                'mensagem' => 'Registro cadastrado com sucesso',
                'filmes' => $enviaDados
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
        $filmes = filmes::find($id);
    
        return(
            $filmes?
            Response()->json(['mensagem'=>'filmes Encontrado',
            'filmes' => $filmes]) :
            'Nenhum filmes encontrado'
        );
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $filmes = $request->all();
    
        $validatedData = Validator::make($filmes, [
            'nome' => 'required',
            'genero' => 'required',
            'sinopse' => 'nullable',
            'lancamento' => 'nullable|date',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json([
                'mensagem' => 'Registros faltantes',
                'erros' => $validatedData->errors()
            ], Response::HTTP_NO_CONTENT);
        }
        
        $filmesAtt = filmes::find($id);
        
        if(!$filmesAtt){ 
        return response()->json([
            'message' => 'filmes não encontrado'
        ], 404);
        }
        
        return(
        $filmesAtt->update($filmes)? 
           response()->json([
                'mensagem' => 'Registro atualizado com sucesso',
                'filmes' => $filmesAtt
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
        $filmes = filmes::find($id);

        if(!$filmes){ 
        return response()->json([
            'message' => 'filmes não encontrado'
        ], 404);
        }
    

        return(
            $filmes->delete()? 
                response()->json([
                    'success' => true,
                    'message' => 'filmes deletado com sucesso'
                ], 200)
            :
            response()->json([
                'success' => false,
                'message' => 'Erro ao deletar o filmes'
            ], 500)
        );
    }
}
