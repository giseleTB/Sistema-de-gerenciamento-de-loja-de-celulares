
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Código</th>
                <th scope="col">Marca</th>
                <th scope="col">Preço</th>
                <th scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estoque as $item)
            <tr>
                <th scope='row'>{{$item->id}}</th>
                <td>{{$item->nome}}</td>
                <td>{{$item->codigo}}</td>
                <td>{{$item->marca}}</td>
                <td>{{$item->preco}}</td>
                <td>{{$item->categorias->categoria ?? "" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
