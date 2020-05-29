<?php

class CategoriasFabricante{

    // Atributos de la clase
    private $id;
    private $nombre;

    // Constructor
    function __construct($id, $nombre){
        $this->setId($id);
        $this->setNombre($nombre);
    }

    // Métodos accesores
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    // Métodos modificadores
    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    // Operaciones CRUD
    public static function registrar($categoria_fabricante){
        $db=Db::getConnect();

        $insert=$db->prepare('INSERT INTO CategoriasFabricante(nombre) VALUES (:nombre)');

        $insert->bindValue( 'nombre',$categoria_fabricante->getNombre() );

        $insert->execute();
    }

    // Método que recupera los todos registros de la tabla
    public static function obtenerCategorias(){
        $db=Db::getConnect();
        $categorias = [];

        $select=$db->query('SELECT id, nombre FROM CategoriasFabricante');

        foreach( $select->fetchAll() as $categoria ){
            $categorias[] = new CategoriasFabricante( $categoria['id'], $categoria['nombre'] );
        }

        return $categorias;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerCategoria($id){
        $db=Db::getConnect();
        $select=$db->prepare('SELECT id, nombre FROM CategoriasFabricante WHERE id=:id');

        $select->bindValue('id', $id);
        $select->execute();

        $categoriaDb=$select->fetch();

        $categoria = new CategoriasFabricante($categoriaDb['id'], $categoriaDb['nombre']);
        
        return $categoria;
    }

    // Método que actualiza la información de una categoría de fabricante
    public static function actualizar($categoria){
        $db=Db::getConnect();
        $update=$db->prepare('UPDATE CategoriasFabricante SET nombre=:nombre WHERE id=:id');

        $update->bindValue('nombre', $categoria->getNombre());

        $update->bindValue('id',$categoria->getId());

        $update->execute();
    }

    // Método que elimina el registro de una categoría de producto
    public static function eliminar($id){
        $db=Db::getConnect();
        
        $delete=$db->prepare('DELETE FROM CategoriasFabricante WHERE id=:id');
        $delete->bindValue('id',$id);
        $delete->execute();		
    }
}

?>