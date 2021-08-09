<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstoqueCategoria extends Model
{
    use HasFactory;

    protected $table = 'estoque_categoria';

    protected $fillable = ["cetegoria"];
}
