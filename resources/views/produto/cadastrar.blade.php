@extends('layout.app')

@section('title', 'Projeto Treinamento Ftt')

@section('content')

    <div class="container">
        <h1>Tela de Cadastrar Produtos</h1>
        <form action="{{route('produto.salvar')}}" method="post">
            @csrf
            <div class="row">
                <div class='form-group col-sm-12 required'>
                    <label>Nome</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-tag mr-1"></i></span>
                        </div>
                        <input type="text" name="nome" class="form-control" placeholder="Nome do Produto" required autofocus />
                    </div>
                </div>
                <div class='form-group col-sm-12 required'>
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Descrição do Produto" required />
                </div>
                <div class='form-group col-sm-12 required'>
                    <label>Valor</label>
                    <input type="text" name="valor" class="form-control money" placeholder="R$ 0,00" required />
                </div>
                <div class='form-group col-sm-12 required'>
                    <label>Categoria</label>
                    <select name="categoria" class="form-control">
                        <option value="">---</option>
                        @foreach($categorias as $k=>$c)
                            <option value="{{$k}}">{{$c}}</option>
                        @endforeach
                    </select>
                </div>
                <div class='form-group col-sm-12'>
                    <button class="btn btn-primary btn-block btn-lg">Adicionar Produto</button>
                </div>
            </div>
        </form>
    </div>

@endsection
