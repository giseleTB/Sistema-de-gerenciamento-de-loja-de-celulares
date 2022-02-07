@extends('layouts.app')

@section('title', 'Formulário de Venda')

@section('sidebar')
@parent
@endsection

@section('script')
<script>
    $(document).ready(function($) {
        $('#cliente_cpf').mask('000.000.000-00');
    });
</script>
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
$action = action('App\Http\Controllers\VendaController@update',$venda->id );
}else{
$action = action('App\Http\Controllers\VendaController@store');
}
@endphp
<h4>Formulário de Vendas</h4>
<form action="{{ $action }}" method="post">
    @csrf
    <div class="form-row">
        <input type="hidden" name="id"
            value="@if(!empty(old('id'))) {{old('id') }}  @elseif (!empty($venda->id)) {{ $venda->id}} @endif">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="@if(!empty(old('nome'))) {{old('nome') }}  @elseif (!empty($venda->nome)) {{ $venda->nome}} @endif"
                placeholder="Nome"><br>

        </div>

        <div class="form-group col-md-6">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control"
                value="@if(!empty(old('codigo'))) {{old('codigo') }}  @elseif (!empty($venda->codigo)) {{ $venda->codigo}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control"
                value="@if(!empty(old('marca'))) {{old('marca') }}  @elseif (!empty($venda->marca)) {{ $venda->marca}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input type="text" name="preco" id="preco" class="form-control"
                value="@if(!empty(old('preco'))) {{old('preco') }}  @elseif (!empty($venda->preco)) {{ $venda->preco}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="cliente_nome">Nome do cliente</label>
            <input type="text" name="cliente_nome" id="cliente_nome" class="form-control"
                value="@if(!empty(old('cliente_nome'))) {{old('cliente_nome') }}  @elseif (!empty($venda->cliente_nome)) {{ $venda->cliente_nome}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="cliente_cpf">CPF do cliente</label>
            <input type="text" name="cliente_cpf" id="cliente_cpf" class="form-control"
                value="@if(!empty(old('cliente_cpf'))) {{old('cliente_cpf') }}  @elseif (!empty($venda->cliente_cpf)) {{ $venda->cliente_cpf}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="cliente_telefone">Telefone do cliente</label>
            <input type="text" name="cliente_telefone" id="cliente_telefone" class="form-control"
                value="@if(!empty(old('cliente_telefone'))) {{old('cliente_telefone') }}  @elseif (!empty($venda->cliente_telefone)) {{ $venda->cliente_telefone}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="venda_categoria_id">Categoria</label>
            <select name="venda_categoria_id" class="form-control">
                <option value="null" @if (old('venda_categoria_id') == 'null') selected @elseif(!empty($venda->venda_categoria_id) && $venda->venda_categoria_id == null) selected @endif></option>
                @foreach ($venda_categorias as $item)
                <option value="{{$item->id}}" @if($item->id == old('venda_categoria_id', !empty($venda->venda_categoria_id))) selected="selected" @endif >{{$item->categoria}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12"> </div>
        <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control"
                placeholder="Sua descrição..."> @if(!empty(old('descricao'))) {{old('descricao') }}  @elseif (!empty($venda->descricao)) {{ $venda->descricao}} @endif</textarea><br>
        </div>
    </div>
    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
    <a href="{{url("/venda")}}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
@endsection
