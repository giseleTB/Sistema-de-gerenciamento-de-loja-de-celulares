<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\EstoqueCategoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class EstoqueController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objResult = Estoque::all();

        return view("estoque.list")->with(['estoque' => $objResult]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estoque_categorias = EstoqueCategoria::all();

        return view("estoque.form")->with(['estoque_categorias' => $estoque_categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), Estoque::rules(), Estoque::message())->validate();

        Estoque::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'marca' => $request->marca,
            'preco' => $request->preco,
            'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
            'descricao' => $request->descricao,
        ]);

        // dd($request);
        return \redirect()->action('App\Http\Controllers\EstoqueController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function move($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->Storage::move();

        return \redirect()->action('App\Http\Controllers\EstoqueController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $objEstoque = Estoque::find($id);
        $estoque_categorias = EstoqueCategoria::all();

        return view("estoque.form")->with(['estoque' => $objEstoque, 'estoque_categorias' => $estoque_categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), Estoque::rules(), Estoque::message())->validate();

        Estoque::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'codigo' => $request->codigo,
                'marca' => $request->marca,
                'preco' => $request->preco,
                'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
                'descricao' => $request->descricao,
            ]
        );

        // dd($request);
        return \redirect()->action('App\Http\Controllers\EstoqueController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);

        $estoque->delete();

        return \redirect()->action('App\Http\Controllers\EstoqueController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        if ($request->tipo == "nome") {
            $objResult = Estoque::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "codigo") {
            $objResult =  Estoque::where('codigo', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "marca") {
            $objResult =  Estoque::where('marca', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "preco") {
            $objResult =  Estoque::where('preco', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "categoria") {
            $objResult = Estoque::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->get();
        }

        return view("estoque.list")->with(['estoque' => $objResult]);
    }

    public function gerarEstoquePDF()
    {

        $estoque = Estoque::all();

        return PDF::loadView('pdf.estoqueList', compact('estoque'))
            ->download('relatorioEstoque.pdf');
        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')

    }
}
