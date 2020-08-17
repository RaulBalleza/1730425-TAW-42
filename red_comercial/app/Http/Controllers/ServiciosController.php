<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;

class ServiciosController extends Controller
{
    public function get(Request $request, $id){
      return Servicios::findOrFail($id);
    }
    
    public function list(Request $request){
      return Servicios::get();
    }

    
    public function listMicrositio(Request $request, $id)
    {
      return Servicios::where('id_micrositio', $id)->get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'id_categoria' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'id_categoria.required' => 'id_categoria is a required field.',
        'id_categoria.max' => 'id_categoria can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
      ]);

        $servicios = Servicios::create($request->all());    
        return $servicios;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'id_categoria' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'id_categoria.required' => 'id_categoria is a required field.',
        'id_categoria.max' => 'id_categoria can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
      ]);

        $servicios = Servicios::findOrFail($id);
        $input = $request->all();
        $servicios->fill($input)->save();
        return $servicios;
    }
    
    public function delete(Request $request, $id){
        $servicios = Servicios::findOrFail($id);
        $servicios->delete();
    }
}
 ?>