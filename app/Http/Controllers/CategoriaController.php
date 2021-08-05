<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * @return array
     */
    public function listar()
    {
        $query = Categoria::all();

        return ['status' => true, "categorias" => $query];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cadastrar(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'descricao' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        $categoria = new Categoria();

        $categoria->descricao = $data['descricao'];

        $categoria->save();

        return ['status' => true, "categoria" => $categoria];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
