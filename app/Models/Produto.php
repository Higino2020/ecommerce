<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public function marca(){
        return $this->belongsTo(Marca::class,'marca_id');
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id');
    }
    public function subcategoria(){
        return $this->belongsTo(SubCategoria::class,'subcategoria_id');
    }
}
