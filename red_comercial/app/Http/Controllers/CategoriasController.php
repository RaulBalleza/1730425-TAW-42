<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;

class CategoriasController extends Controller
{
    public function get(Request $request, $id){
      return Categorias::findOrFail($id);
    }
    
    public function list(Request $request){
      return Categorias::get();
    }

    public function listMicrositio(Request $request, $id)
    {
      return Categorias::where('id_micrositio', $id)->get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
      ]);

        $categorias = Categorias::create($request->all());    
        return $categorias;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_micrositio' => 'required |max:20 ',
        'nombre' => 'required |max:255 ',
      ],[
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
      ]);

        $categorias = Categorias::findOrFail($id);
        $input = $request->all();
        $categorias->fill($input)->save();
        return $categorias;
    }
    
    public function delete(Request $request, $id){
        $categorias = Categorias::findOrFail($id);
        $categorias->delete();
    }
}
 ?>