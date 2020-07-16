<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micrositios;

class MicrositiosController extends Controller
{
    public function get(Request $request, $id){
      return Micrositios::findOrFail($id);
    }
    
    public function list(Request $request){
      return Micrositios::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'direccion' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'direccion.required' => 'direccion is a required field.',
        'direccion.max' => 'direccion can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
      ]);

        $micrositios = Micrositios::create($request->all());    
        return $micrositios;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'direccion' => 'required |max:255 ',
        'descripcion' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'direccion.required' => 'direccion is a required field.',
        'direccion.max' => 'direccion can only be 255 characters.',
        'descripcion.required' => 'descripcion is a required field.',
        'descripcion.max' => 'descripcion can only be 255 characters.',
      ]);

        $micrositios = Micrositios::findOrFail($id);
        $input = $request->all();
        $micrositios->fill($input)->save();
        return $micrositios;
    }
    
    public function delete(Request $request, $id){
        $micrositios = Micrositios::findOrFail($id);
        $micrositios->delete();
    }
}
 ?>