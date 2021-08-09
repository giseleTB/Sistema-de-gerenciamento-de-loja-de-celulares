@extends('layouts.app')

@section('title', 'Formulário de Fornecedor')

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
$action = action('App\Http\Controllers\FornecedorController@update',$fornecedor->id );
}else{
$action = action('App\Http\Controllers\FornecedorController@store');
}
@endphp
<h4>Formulário de Fornecedores</h4>
<form action="{{ $action }}" method="post">
    @csrf
    <div class="form-row">
        <input type="hidden" name="id"
            value="@if(!empty(old('id'))) {{old('id') }}  @elseif (!empty($fornecedor->id)) {{ $fornecedor->id}} @endif">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="@if(!empty(old('nome'))) {{old('nome') }}  @elseif (!empty($fornecedor->nome)) {{ $fornecedor->nome}} @endif"
                placeholder="Nome"><br>
        </div>

        <div class="form-group col-md-12"></div>

        <div class="form-group col-md-6">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control"
                value="@if(!empty(old('telefone'))) {{old('telefone') }}  @elseif (!empty($fornecedor->telefone)) {{ $fornecedor->telefone}} @endif"><br>
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control"
                value="@if(!empty(old('email'))) {{old('email') }}  @elseif (!empty($fornecedor->email)) {{ $fornecedor->email}} @endif"><br>
        </div>

    </div>
    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
    <a href="{{url("/fornecedor")}}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
@endsection
