<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    public function get(Request $request, $id){
      return Users::findOrFail($id);
    }
    
    public function list(Request $request){
      return Users::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'name' => 'required |max:255 ',
        'email' => 'required |max:255 ',
        'password' => 'required |max:255 ',
      ],[
        'name.required' => 'name is a required field.',
        'name.max' => 'name can only be 255 characters.',
        'email.required' => 'email is a required field.',
        'email.max' => 'email can only be 255 characters.',
        'password.required' => 'password is a required field.',
        'password.max' => 'password can only be 255 characters.',
      ]);

        $users = Users::create($request->all());    
        return $users;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'name' => 'required |max:255 ',
        'email' => 'required |max:255 ',
        'password' => 'required |max:255 ',
      ],[
        'name.required' => 'name is a required field.',
        'name.max' => 'name can only be 255 characters.',
        'email.required' => 'email is a required field.',
        'email.max' => 'email can only be 255 characters.',
        'password.required' => 'password is a required field.',
        'password.max' => 'password can only be 255 characters.',
      ]);

        $users = Users::findOrFail($id);
        $input = $request->all();
        $users->fill($input)->save();
        return $users;
    }
    
    public function delete(Request $request, $id){
        $users = Users::findOrFail($id);
        $users->delete();
    }
}
 ?>