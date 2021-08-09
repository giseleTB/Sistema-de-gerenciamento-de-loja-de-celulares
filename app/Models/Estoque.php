<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';

    protected $fillable = ["nome", "codigo", "marca", "preco", "descricao", 'estoque_categoria_id'];


    public static function rules()
    {
        return [
            'nome' => 'required|max:80',
            'codigo' => 'required|max:20',
            'marca' => 'required|max:80',
            'preco' => 'required|max:20',
            'estoque_categoria_id' => 'required',
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
            'descricao.required' => 'O descrição é obrigatório',
            'descricao.max' => 'Só é permitido 150 caracteres',
            'estoque_categoria_id.required' => 'A categoria é obrigatório',
        ];
    }

    /**
     * Get the post that owns the categorias.
     */
    public function categorias()
    {
        return $this->belongsTo(EstoqueCategoria::class, 'estoque_categoria_id', 'id');
    }

}
