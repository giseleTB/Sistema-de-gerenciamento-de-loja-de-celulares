<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaCategoria extends Model
{
    use HasFactory;

    protected $table = 'venda_categoria';

    protected $fillable = ["venda"];
}
