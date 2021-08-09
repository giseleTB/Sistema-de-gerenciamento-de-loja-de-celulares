<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\VendaCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class VendaController extends Controller
{
    public function index()
    {
        $objResult = Venda::all();

        return view("venda.list")->with(['venda' => $objResult]);
    }

    public function create()
    {
        $venda_categorias = VendaCategoria::all();

        return view("venda.form")->with(['venda_categorias' => $venda_categorias]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), Venda::rules(), Venda::message())->validate();

        Venda::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'marca' => $request->marca,
            'preco' => $request->preco,
            'cliente_nome' => $request->cliente_nome,
            'cliente_cpf' => $request->cliente_cpf,
            'cliente_telefone' => $request->cliente_telefone,
            'venda_categoria_id' => $request->venda_categoria_id,
            'descricao' => $request->descricao,
        ]);

        // dd($request);
        return \redirect()->action('App\Http\Controllers\VendaController@index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $objVenda = Venda::find($id);
        $venda_categorias = VendaCategoria::all();

        return view("venda.form")->with(['venda' => $objVenda, 'venda_categorias' => $venda_categorias]);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), Venda::rules(), Venda::message())->validate();

        Venda::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'codigo' => $request->codigo,
                'marca' => $request->marca,
                'preco' => $request->preco,
                'cliente_nome' => $request->cliente_nome,
                'cliente_cpf' => $request->cliente_cpf,
                'cliente_telefone' => $request->cliente_telefone,
                'venda_categoria_id' => $request->venda_categoria_id == 'null' ? null : $request->venda_categoria_id,
                'descricao' => $request->descricao,
            ]
        );

        // dd($request);
        return \redirect()->action('App\Http\Controllers\VendaController@index');
    }

    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);

        $venda->delete();

        return \redirect()->action('App\Http\Controllers\VendaController@index');
    }

    public function search(Request $request)
    {

        if ($request->tipo == "nome") {
            $objResult = Venda::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "codigo") {
            $objResult =  Venda::where('codigo', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "marca") {
            $objResult =  Venda::where('marca', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "preco") {
            $objResult =  Venda::where('preco', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "cliente_nome") {
            $objResult =  Venda::where('cliente_nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "cliente_cpf") {
            $objResult =  Venda::where('cliente_cpf', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "cliente_telefone") {
            $objResult =  Venda::where('cliente_telefone', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "categoria") {
            $objResult = Venda::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->get();
        }

        return view("venda.list")->with(['venda' => $objResult]);
    }

    public function gerarVendaPDF()
    {

        $venda = Venda::all();

        return PDF::loadView('pdf.vendaList', compact('venda'))
            ->download('relatorioVenda.pdf');
        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')

    }
}
