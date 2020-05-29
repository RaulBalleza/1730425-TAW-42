<?php 
class Producto {

  // Atributos de la clase
  private $id;
  private $nombre;
  private $descripcion;
  private $precio_compra;
  private $precio_venta;
  private $color;
  private $id_categoria;

  // Constructor
  function __construct($id, $nombre, $descripcion, $color, $precio_compra, $precio_venta, $id_categoria){
    $this->setId($id);
    $this->setNombre($nombre);
    $this->setDescripcion($descripcion);
    $this->setColor($color);
    $this->setPrecioCompra($precio_compra);
    $this->setPrecioVenta($precio_venta);
    $this->setIdCategoria($id_categoria);
  }

  // Métodos accesores
  public function getId(){
		return $this->id;
  }
    
	public function getNombre(){
		return $this->nombre;
  }

  public function getDescripcion(){
		return $this->descripcion;
  }

  public function getPrecioCompra(){
    return $this->precio_compra;
  }

  public function getPrecioVenta(){
    return $this->precio_venta;
  }

  public function getColor(){
    return $this->color;
  }
  
  public function getIdCategoria(){
    return $this->id_categoria;
  }
    
  // Métodos modificadores
  public function setId($id){
    $this->id = $id;
  }
    
  public function setNombre($nombre){
		$this->nombre = $nombre;
	}
    
  public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
  }

  public function setPrecioCompra($precio_compra){
		$this->precio_compra = $precio_compra;
  }
    
  public function setPrecioVenta($precio_venta){
    $this->precio_venta = $precio_venta;
  }
  
  public function setColor($color){
    $this->color = $color;
  }
  
  public function setIdCategoria($id_categoria){
    $this->id_categoria = $id_categoria;
  }
    
  // Operaciones CRUD
  public static function registrar($producto){
		$db=Db::getConnect();

		$insert=$db->prepare('INSERT INTO Productos (nombre,descripcion,precio_compra,precio_venta,color,id_categoria) VALUES (:nombre,:descripcion,:precio_compra,:precio_venta,:color,:id_categoria)');
        
    $insert->bindValue( 'nombre',$producto->getNombre() );
    $insert->bindValue( 'descripcion',$producto->getDescripcion() );
    $insert->bindValue( 'color',$producto->getColor() );
    $insert->bindValue( 'precio_compra',$producto->getPrecioCompra() );
    $insert->bindValue( 'precio_venta',$producto->getPrecioVenta() );
    $insert->bindValue( 'id_categoria',$producto->getIdCategoria() );

    $insert->execute();
  }
  
  // Método que recupera los todos registros de la tabla
  public static function obtenerProductos(){
		$db=Db::getConnect();
    $productos = [];

		$select=$db->query('SELECT id, nombre, descripcion, precio_compra, precio_venta, color, id_categoria FROM Productos');

		foreach( $select->fetchAll() as $producto ){
			$productos[] = new Producto($producto['id'], $producto['nombre'], $producto['descripcion'], $producto['color'], $producto['precio_compra'], $producto['precio_venta'], $producto['id_categoria']);
    }
    
		return $productos;
  }

  // Método que recupera únicamente un registro de la tabla
  public static function obtenerProducto($id){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT id, nombre, descripcion, precio_compra, precio_venta, color, id_categoria FROM Productos WHERE id=:id');
    
    $select->bindValue('id', $id);
		$select->execute();

		$productoDb=$select->fetch();

		$producto = new Producto($productoDb['id'], $productoDb['nombre'], $productoDb['descripcion'], $productoDb['color'], $productoDb['precio_compra'], $productoDb['precio_venta'], $productoDb['id_categoria']);
		return $producto;

  }
  
  // Método que actualiza la información de un producto
	public static function actualizar($producto){
		$db=Db::getConnect();
    $update=$db->prepare('UPDATE Productos SET nombre=:nombre, descripcion=:descripcion, precio_compra=:precio_compra, precio_venta=:precio_venta, color=:color, id_categoria=:id_categoria WHERE id=:id');
    
		$update->bindValue('nombre', $producto->getNombre());
		$update->bindValue('descripcion',$producto->getDescripcion());
    $update->bindValue('precio_compra',$producto->getPrecioCompra());
    $update->bindValue('precio_venta', $producto->getPrecioVenta());
		$update->bindValue('color',$producto->getColor());
    $update->bindValue('id_categoria',$producto->getIdCategoria());
    
    $update->bindValue('id',$producto->getId());
    
		$update->execute();
  }

  // Método que elimina el registro de una categoría de producto
  public static function eliminar($id){
    $db=Db::getConnect();
        
    $delete=$db->prepare('DELETE FROM Productos WHERE id=:id');
    $delete->bindValue('id',$id);
    $delete->execute();		
  }
  
}

?>