<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
    public function get(Request $request, $id){
      return Products::findOrFail($id);
    }
    
    public function list(Request $request){
      return Products::get();
    }

    public function listMicrositio(Request $request,$id){
      return Products::where('id_micrositio',$id)->get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
        'stock' => 'required |max:11 ',
        'costo' => 'required |max:8 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
        'stock.required' => 'stock is a required field.',
        'stock.max' => 'stock can only be 11 characters.',
        'costo.required' => 'costo is a required field.',
        'costo.max' => 'costo can only be 8 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
      ]);

        $products = Products::create($request->all());    
        return $products;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
        'stock' => 'required |max:11 ',
        'costo' => 'required |max:8 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
        'stock.required' => 'stock is a required field.',
        'stock.max' => 'stock can only be 11 characters.',
        'costo.required' => 'costo is a required field.',
        'costo.max' => 'costo can only be 8 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
      ]);

        $products = Products::findOrFail($id);
        $input = $request->all();
        $products->fill($input)->save();
        return $products;
    }
    
    public function delete(Request $request, $id){
        $products = Products::findOrFail($id);
        $products->delete();
    }
}
 ?>