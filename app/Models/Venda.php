<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'venda';

    protected $fillable = ["nome", "codigo", "marca", "preco", "cliente_nome", "cliente_cpf", "cliente_telefone", "descricao", 'venda_categoria_id'];

    public static function rules()
    {
        return [
            'nome' => 'required|max:80',
            'codigo' => 'required|max:20',
            'marca' => 'required|max:80',
            'preco' => 'required|max:20',
            'cliente_nome' => 'required|max:100',
            'cliente_cpf' => 'required|max:50',
            'cliente_telefone' => 'required|max:50',
            'preco' => 'required|max:50',
            'venda_categoria_id' => 'required',
            'descricao' => 'required|max:150',
        ];
    }

    public static function message()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 80 caracteres',
            'codigo.required' => 'O código é obrigatório',
            'codigo.max' => 'Só é permitido 20 caracteres',
            'marca.required' => 'A marca é obrigatória',
            'marca.max' => 'Só é permitido 80 caracteres',
            'preco.required' => 'O preço é obrigatório',
            'preco.max' => 'Só é permitido 20 caracteres',
            'cliente_nome.required' => 'O preço é obrigatório',
            'cliente_nome.max' => 'Só é permitido 100 caracteres',
            'cliente_cpf.required' => 'O preço é obrigatório',
            'cliente_cpf.max' => 'Só é permitido 50 caracteres',
            'cliente_telefone.required' => 'O preço é obrigatório',
            'cliente_telefone.max' => 'Só é permitido 50 caracteres',
            'descricao.required' => 'O descrição é obrigatório',
            'descricao.max' => 'Só é permitido 150 caracteres',
            'vendae_categoria_id.required' => 'A categoria é obrigatório',
        ];
    }

    public function categorias()
    {
        return $this->belongsTo(VendaCategoria::class, 'venda_categoria_id', 'id');
    }

}
