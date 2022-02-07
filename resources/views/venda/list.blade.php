@extends('layouts.app')

@section('title', 'Listagem de Venda')

@section('sidebar')
@parent
@endsection

@section('grafico')
<div class="row">
    <div class="col-6">
        {!! $chartVenda->container()!!}
        {{ $chartVenda->script()}}
    </div>
</div>
@stop

@section('content')
<h1 align =center><strong>Vendas</strong></h1>
<br>

<form action="{{ action('App\Http\Controllers\VendaController@search') }}" method="post" >
    @csrf
    <div class="form-row" >
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Digite sua pesquisa..." name="valor" id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value="nome">Nome</option>
                <option value="codigo">Código</option>
                <option value="marca">Marca</option>
                <option value="preco">Preço</option>
                <option value="cliente_nome">Cliente</option>
                <option value="cliente_cpf">CPF</option>
                <option value="cliente_telefone">Telefone</option>
                <option value="categoria">Categoria</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
        <div class="col-3">
            <a href="{{url("/venda/create")}}" class="btn btn-success"> <i class="fas fa-plus-circle"></i> Cadastrar</a>
            <a href="{{url("/venda-relatorio")}}" class="btn btn-danger"> <i class="fas fa-file-pdf"></i> Relatório</a>

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
            <th scope="col">Código</th>
            <th scope="col">Marca</th>
            <th scope="col">Preço</th>
            <th scope="col">Cliente</th>
            <th scope="col">CPF</th>
            <th scope="col">Telefone</th>
            <th scope="col">Categoria</th>
            <th scope="col">Editar</th>
            <th scope="col">Remover</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($venda as $item)
        <tr>
            <th scope='row'>{{$item->id}}</th>
            <td>{{$item->nome}}</td>
            <td>{{$item->codigo}}</td>
            <td>{{$item->marca}}</td>
            <td>{{$item->preco}}</td>
            <td>{{$item->cliente_nome}}</td>
            <td>{{$item->cliente_cpf}}</td>
            <td>{{$item->cliente_telefone}}</td>
            <td>{{$item->categorias->categoria ?? "" }}</td>
            <td><a href="{{ action('App\Http\Controllers\VendaController@edit',$item->id) }}" style='color:orange;'><i
                        class='fas fa-edit'></i></a>
            </td>
            <td><a href='{{ action('App\Http\Controllers\VendaController@destroy', $item->id) }}'
                    onclick="return confirm('Deseja realmente remover o registro?');"  style='color:red;'><i
                        class='fas fa-trash'></i></a> </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$venda->links()}}
@endsection
