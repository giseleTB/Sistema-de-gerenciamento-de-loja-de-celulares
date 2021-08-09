@extends('layouts.app')

@section('title', 'Listagem de Fornecedor')

@section('sidebar')
@parent
@endsection

@section('content')
<h4>Listagem de Fornecedores</h4>
<p></p>

<form action="{{ action('App\Http\Controllers\FornecedorController@search') }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Digite sua pesquisa..." name="valor" id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value="nome">Nome</option>
                <option value="telefone">Telefone</option>
                <option value="email">Email</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
        <div class="col-3">
            <a href="{{url("/fornecedor/create")}}" class="btn btn-success"> <i class="fas fa-plus-circle"></i> Cadastrar</a>
            <a href="{{url("/fornecedor-relatorio")}}" class="btn btn-danger"> <i class="fas fa-file-pdf"></i> Relatório</a>

        </div>
    </div>
</form>
<p>
</p>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Editar</th>
            <th scope="col">Remover</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fornecedor as $item)
        <tr>
            <th scope='row'>{{$item->id}}</th>
            <td>{{$item->nome}}</td>
            <td>{{$item->telefone}}</td>
            <td>{{$item->email}}</td>
            <td><a href="{{ action('App\Http\Controllers\FornecedorController@edit',$item->id) }}" style='color:orange;'><i
                        class='fas fa-edit'></i></a>
            </td>
            <td><a href='{{ action('App\Http\Controllers\FornecedorController@destroy', $item->id) }}'
                    onclick="return confirm('Deseja realmente remover o registro?');"  style='color:red;'><i
                        class='fas fa-trash'></i></a> </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
