<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function get(Request $request, $id){
      return Roles::findOrFail($id);
    }
    
    public function list(Request $request){
      return Roles::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'name' => 'required |max:255 ',
        'slug' => 'required |max:255 ',
        'level' => 'required |max:11 ',
      ],[
        'name.required' => 'name is a required field.',
        'name.max' => 'name can only be 255 characters.',
        'slug.required' => 'slug is a required field.',
        'slug.max' => 'slug can only be 255 characters.',
        'level.required' => 'level is a required field.',
        'level.max' => 'level can only be 11 characters.',
      ]);

        $roles = Roles::create($request->all());    
        return $roles;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'name' => 'required |max:255 ',
        'slug' => 'required |max:255 ',
        'level' => 'required |max:11 ',
      ],[
        'name.required' => 'name is a required field.',
        'name.max' => 'name can only be 255 characters.',
        'slug.required' => 'slug is a required field.',
        'slug.max' => 'slug can only be 255 characters.',
        'level.required' => 'level is a required field.',
        'level.max' => 'level can only be 11 characters.',
      ]);

        $roles = Roles::findOrFail($id);
        $input = $request->all();
        $roles->fill($input)->save();
        return $roles;
    }
    
    public function delete(Request $request, $id){
        $roles = Roles::findOrFail($id);
        $roles->delete();
    }
}
 ?>