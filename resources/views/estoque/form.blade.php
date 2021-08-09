@extends('layouts.app')

@section('title', 'Formulário de Estoque')

@section('sidebar')
@parent
@endsection

@section('content')
<p></p>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@php
if(!empty(Request::route('id'))){
$action = action('App\Http\Controllers\EstoqueController@update',$estoque->id );
}else{
$action = action('App\Http\Controllers\EstoqueController@store');
}
@endphp
<h4>Formulário de Estoque</h4>
<form action="{{ $action }}" method="post">
    @csrf
    <div class="form-row">
        <input type="hidden" name="id"
            value="@if(!empty(old('id'))) {{old('id') }}  @elseif (!empty($estoque->id)) {{ $estoque->id}} @endif">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="@if(!empty(old('nome'))) {{old('nome') }}  @elseif (!empty($estoque->nome)) {{ $estoque->nome}} @endif"
                placeholder="Nome"><br>

        </div>

        <div class="form-group col-md-12"> </div>

        <div class="form-group col-md-6">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control"
                value="@if(!empty(old('codigo'))) {{old('codigo') }}  @elseif (!empty($estoque->codigo)) {{ $estoque->codigo}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control"
                value="@if(!empty(old('marca'))) {{old('marca') }}  @elseif (!empty($estoque->marca)) {{ $estoque->marca}} @endif"><br>
        </div>



        <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input type="text" name="preco" id="preco" class="form-control"
                value="@if(!empty(old('preco'))) {{old('preco') }}  @elseif (!empty($estoque->preco)) {{ $estoque->preco}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="estoque_categoria_id">Categoria</label>
            <select name="estoque_categoria_id" class="form-control">
                <option value="null" @if (old('estoque_categoria_id') == 'null') selected @elseif(!empty($estoque->estoque_categoria_id) && $estoque->estoque_categoria_id == null) selected @endif></option>
                @foreach ($estoque_categorias as $item)
                <option value="{{$item->id}}" @if($item->id == old('estoque_categoria_id', !empty($estoque->estoque_categoria_id))) selected="selected" @endif >{{$item->categoria}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"
                placeholder="Sua descrição..."> @if(!empty(old('descricao'))) {{old('descricao') }}  @elseif (!empty($estoque->descricao)) {{ $estoque->descricao}} @endif</textarea><br>
        </div>
    </div>
    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
    <a href="{{url("/estoque")}}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
@endsection
