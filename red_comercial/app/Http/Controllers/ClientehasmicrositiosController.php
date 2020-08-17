<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientehasmicrositios;

class ClientehasmicrositiosController extends Controller
{
    public function get(Request $request, $id){
      return Clientehasmicrositios::findOrFail($id);
    }
    
    public function list(Request $request){
      return Clientehasmicrositios::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_user' => 'required |max:20 ',
        'id_micrositio' => 'required |max:20 ',
      ],[
        'id_user.required' => 'id_user is a required field.',
        'id_user.max' => 'id_user can only be 20 characters.',
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
      ]);

        $clientehasmicrositios = Clientehasmicrositios::create($request->all());    
        return $clientehasmicrositios;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_user' => 'required |max:20 ',
        'id_micrositio' => 'required |max:20 ',
      ],[
        'id_user.required' => 'id_user is a required field.',
        'id_user.max' => 'id_user can only be 20 characters.',
        'id_micrositio.required' => 'id_micrositio is a required field.',
        'id_micrositio.max' => 'id_micrositio can only be 20 characters.',
      ]);

        $clientehasmicrositios = Clientehasmicrositios::findOrFail($id);
        $input = $request->all();
        $clientehasmicrositios->fill($input)->save();
        return $clientehasmicrositios;
    }
    
    public function delete(Request $request, $id){
        $clientehasmicrositios = Clientehasmicrositios::findOrFail($id);
        $clientehasmicrositios->delete();
    }
}
 ?>