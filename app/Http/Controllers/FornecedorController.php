<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class FornecedorController extends Controller
{
    public function index()
    {
        $objResult = Fornecedor::all();

        return view("fornecedor.list")->with(['fornecedor' => $objResult]);
    }

    public function create()
    {
        $fornecedor = Fornecedor::all();

        return view("fornecedor.form")->with(['fornecedor' => $fornecedor]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), Fornecedor::rules(), Fornecedor::message())->validate();

        Fornecedor::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
        ]);

        // dd($request);
        return \redirect()->action('App\Http\Controllers\FornecedorController@index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $objFornecedor = Fornecedor::find($id);
        $fornecedor = Fornecedor::all();

        return view("fornecedor.form")->with(['fornecedor' => $objFornecedor, 'fornecedor' => $fornecedor]);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), Fornecedor::rules(), Fornecedor::message())->validate();

        Fornecedor::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
            ]
        );

        // dd($request);
        return \redirect()->action('App\Http\Controllers\FornecedorController@index');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->delete();

        return \redirect()->action('App\Http\Controllers\FornecedorController@index');
    }

    public function search(Request $request)
    {

        if ($request->tipo == "nome") {
            $objResult = Fornecedor::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "telefone") {
            $objResult =  Fornecedor::where('telefone', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "email") {
            $objResult =  Fornecedor::where('email', 'like', "%" . $request->valor . "%")->get();
        }

        return view("fornecedor.list")->with(['fornecedor' => $objResult]);
    }

    public function gerarFornecedorPDF()
    {

        $fornecedor = Fornecedor::all();

        return PDF::loadView('pdf.fornecedorList', compact('fornecedor'))
            ->download('relatorioFornecedor.pdf');
        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')

    }

}
