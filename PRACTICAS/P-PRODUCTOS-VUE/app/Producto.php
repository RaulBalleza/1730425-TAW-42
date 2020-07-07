<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //Se declaran los atributos que se necesitan para hacer una insercion a la BD
    protected $fillable = ['nombre', 'descripcion'];
}
