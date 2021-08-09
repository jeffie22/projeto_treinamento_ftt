<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salvar(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required',
            'categoria' => 'required',
        ]);

        if ($validacao->fails()) {
            return redirect()->back()->withInput($data);
        }

        $produto = new Produto();

        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->valor = $data['valor'];
        $produto->categoria_id = $data['categoria'];

        $produto->save();

        return redirect()->route('produto.listar');


    }

    public function cadastrar()
    {
        $categorias = Categoria::pluck('descricao','id');

        return view('produto.cadastrar',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        $produtos = Produto::with('categoria')
            ->paginate(10);

        return view('produto.listar',compact('produtos'));

//        return ['status' => true, "produtos" => $query];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
