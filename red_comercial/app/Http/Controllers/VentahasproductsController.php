<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventahasproducts;

class VentahasproductsController extends Controller
{
    public function get(Request $request, $id){
      return Ventahasproducts::findOrFail($id);
    }
    
    public function list(Request $request){
      return Ventahasproducts::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_venta' => 'required |max:20 ',
        'id_product' => 'required |max:20 ',
      ],[
        'id_venta.required' => 'id_venta is a required field.',
        'id_venta.max' => 'id_venta can only be 20 characters.',
        'id_product.required' => 'id_product is a required field.',
        'id_product.max' => 'id_product can only be 20 characters.',
      ]);

        $ventahasproducts = Ventahasproducts::create($request->all());    
        return $ventahasproducts;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_venta' => 'required |max:20 ',
        'id_product' => 'required |max:20 ',
      ],[
        'id_venta.required' => 'id_venta is a required field.',
        'id_venta.max' => 'id_venta can only be 20 characters.',
        'id_product.required' => 'id_product is a required field.',
        'id_product.max' => 'id_product can only be 20 characters.',
      ]);

        $ventahasproducts = Ventahasproducts::findOrFail($id);
        $input = $request->all();
        $ventahasproducts->fill($input)->save();
        return $ventahasproducts;
    }
    
    public function delete(Request $request, $id){
        $ventahasproducts = Ventahasproducts::findOrFail($id);
        $ventahasproducts->delete();
    }
}
 ?>