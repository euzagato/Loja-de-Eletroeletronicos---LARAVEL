<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['prod_nome', 'prod_descricao', 'prod_categoria', 'prod_quantidade', 'prod_preco', 'prod_foto'];
}
