<?php

namespace App\Http\Controllers;

use App\Mail\SendMailEstoque;
use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\EstoqueCategoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        $objResult = Estoque::paginate(10);

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

        $input = $request->all();
        $imagem = $request->file("nome_arquivo");
        if ($imagem) {
        $nome_arquivo = date('YmdHis') .".". $imagem->getClientOriginalExtension();
        $request->nome_arquivo->storeAs('public/imagem', $nome_arquivo);
        $input['nome_arquivo'] = $nome_arquivo;

        Estoque::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'marca' => $request->marca,
            'preco' => $request->preco,
            'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
            'descricao' => $request->descricao,
            'nome_arquivo' => $nome_arquivo
        ]);

        } else {
            Estoque::create([
                'nome' => $request->nome,
                'codigo' => $request->codigo,
                'marca' => $request->marca,
                'preco' => $request->preco,
                'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
                'descricao' => $request->descricao
            ]);
        }


        // dd($request);
        return \redirect()->action('App\Http\Controllers\EstoqueController@index')->with('success','Registro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
    public function update(Request $request, $id){


        Validator::make($request->all(), Estoque::rules(), Estoque::message())->validate();

        $input = $request->all();
        $imagem = $request->file("nome_arquivo");
        if ($imagem) {
        $nome_arquivo = date('YmdHis') .".". $imagem->getClientOriginalExtension();
        $request->nome_arquivo->storeAs('public/imagem', $nome_arquivo);
            $input['nome_arquivo'] = $nome_arquivo;
        Estoque::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'codigo' => $request->codigo,
                'marca' => $request->marca,
                'preco' => $request->preco,
                'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
                'descricao' => $request->descricao,
                'nome_arquivo' => $nome_arquivo
            ]);
        } else {
            Estoque::updateOrCreate(
                ['id' => $request->id],
                [
                    'nome' => $request->nome,
                    'codigo' => $request->codigo,
                    'marca' => $request->marca,
                    'preco' => $request->preco,
                    'estoque_categoria_id' => $request->estoque_categoria_id == 'null' ? null : $request->estoque_categoria_id,
                    'descricao' => $request->descricao,
                ]);
        }

        // dd($request);
        return \redirect()->action('App\Http\Controllers\EstoqueController@index')->with('success','Registro atualizado com sucesso!');
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

        if (Storage::exists("public/imagem/" . $estoque->nome_arquivo)) {
            Storage::delete("public/imagem/" . $estoque->nome_arquivo);
        }

        $estoque->delete();

        return \redirect()->action('App\Http\Controllers\EstoqueController@index')->with('success','Registro removido com sucesso!');
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
            $objResult = Estoque::where('nome', 'like', "%" . $request->valor . "%")->paginate(10);
        } else if ($request->tipo == "codigo") {
            $objResult =  Estoque::where('codigo', 'like', "%" . $request->valor . "%")->paginate(10);
        } else if ($request->tipo == "marca") {
            $objResult =  Estoque::where('marca', 'like', "%" . $request->valor . "%")->paginate(10);
        } else if ($request->tipo == "preco") {
            $objResult =  Estoque::where('preco', 'like', "%" . $request->valor . "%")->paginate(10);
        } else if ($request->tipo == "categoria") {
            $objResult = Estoque::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->paginate(10);
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

    public function sendEmail()
    {
        $estoque = [];
        $estoque['estoque'] = Estoque::paginate(5);

        try {
            Mail::to('giseletbrin@gmail.com')
                ->send(new SendMailEstoque($estoque));

            return \redirect()->action('App\Http\Controllers\EstoqueController@index')->with('success', 'Envio de email realizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }


}
