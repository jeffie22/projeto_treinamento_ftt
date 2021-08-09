@extends('layout.app')

@section('title', 'Projeto Treinamento Ftt')

@section('content')

    <div class="container-fluid">
        <h1>Tela de Listar Produtos</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->categoria->descricao ?? '---'}}</td>
                    <td>{{$produto->descricao}}</td>
                    <td>{{$produto->valor_show}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

