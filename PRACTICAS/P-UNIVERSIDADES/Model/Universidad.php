<?php

class Universidad{

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
    public static function registrar($universidad){
        $db=Db::getConnect();

        $insert=$db->prepare('INSERT INTO Universidades(nombre) VALUES (:nombre)');

        $insert->bindValue( 'nombre',$universidad->getNombre() );

        $insert->execute();
    }

    // Método que recupera los todos registros de la tabla
    public static function obtenerUniversidades(){
        $db=Db::getConnect();
        $universidades = [];

        $select=$db->query('SELECT id, nombre FROM Universidades');

        foreach( $select->fetchAll() as $universidad ){
            $universidades[] = new Universidad( $universidad['id'], $universidad['nombre'] );
        }

        return $universidades;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerUniversidad($id){
        $db=Db::getConnect();
        $select=$db->prepare('SELECT id, nombre FROM Universidades WHERE id=:id');

        $select->bindValue('id', $id);
        $select->execute();

        $universidadDb=$select->fetch();

        $universidad = new Universidad($universidadDb['id'], $universidadDb['nombre']);
        
        return $universidad;
    }

    // Método que actualiza la información de una categoría de producto
    public static function actualizar($universidad){
        $db=Db::getConnect();
        $update=$db->prepare('UPDATE Universidades SET nombre=:nombre WHERE id=:id');

        $update->bindValue('nombre', $universidad->getNombre());

        $update->bindValue('id',$universidad->getId());

        $update->execute();
    }

    // Método que elimina el registro de una categoría de producto
    public static function eliminar($id){
		$db=Db::getConnect();
        
        $delete=$db->prepare('DELETE FROM Universidades WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>