<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedor';

    protected $fillable = ["nome", "telefone", "email"];

    public static function rules()
    {
        return [
            'nome' => 'required|max:100',
            'telefone' => 'required|max:50',
            'email' => 'max:100',
        ];
    }

    public static function message()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 100 caracteres',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.max' => 'Só é permitido 50 caracteres',
            'email.max' => 'Só é permitido 100 caracteres',
        ];
    }
}
