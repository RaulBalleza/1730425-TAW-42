<?php 

class Fabricante {

    // Atributos de la clase
    private $id;
    private $nombre;
    private $direccion;
    private $email;
    private $telefono;
    private $id_categoria;

    // Constructor
    function __construct($id, $nombre, $direccion, $email, $telefono, $id_categoria){
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);
        $this->setEmail($email);
        $this->setTelefono($telefono);
        $this->setIdCategoria($id_categoria);
    }
    
    // Métodos accesores
    public function getId(){
		return $this->id;
    }
        
    public function getNombre(){
        return $this->nombre;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelefono(){
        return $this->telefono;
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

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setIdCategoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }

    // Operaciones CRUD
    public static function registrar($fabricante){
        $db=Db::getConnect();

        $insert=$db->prepare('INSERT INTO Fabricantes (nombre, direccion, email, telefono, id_categoria) VALUES (:nombre, :direccion, :email, :telefono, :id_categoria)');
        
        $insert->bindValue( 'nombre',$fabricante->getNombre() );
        $insert->bindValue( 'direccion',$fabricante->getDireccion() );
        $insert->bindValue( 'email',$fabricante->getEmail() );
        $insert->bindValue( 'telefono',$fabricante->getTelefono() );
        $insert->bindValue( 'id_categoria',$fabricante->getIdCategoria() );

        $insert->execute();
    }

    // Método que recupera los todos registros de la tabla
    public static function obtenerFabricantes(){
        $db=Db::getConnect();
        $fabricantes = [];

        $select=$db->query('SELECT id, nombre, direccion, email, telefono, id_categoria FROM Fabricantes');

        foreach( $select->fetchAll() as $fabricante ){
            $fabricantes[] = new Fabricante($fabricante['id'], $fabricante['nombre'], $fabricante['direccion'], $fabricante['email'], $fabricante['telefono'], $fabricante['id_categoria']);
        }

        return $fabricantes;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerFabricante($id){
        $db=Db::getConnect();
        $select=$db->prepare('SELECT id, nombre, direccion, email, telefono, id_categoria FROM Fabricantes WHERE id=:id');

        $select->bindValue('id', $id);
        $select->execute();

        $fabricanteDb=$select->fetch();

        $fabricante = new Fabricante($fabricanteDb['id'], $fabricanteDb['nombre'], $fabricanteDb['direccion'], $fabricanteDb['email'], $fabricanteDb['telefono'], $fabricanteDb['id_categoria']);
        
        return $fabricante;
    }

    // Método que actualiza la información de un fabricante
    public static function actualizar($fabricante){
        $db=Db::getConnect();
        $update=$db->prepare('UPDATE Fabricantes SET nombre=:nombre, direccion=:direccion, email=:email, telefono=:telefono, id_categoria=:id_categoria WHERE id=:id');

        $update->bindValue('nombre', $fabricante->getNombre());
        $update->bindValue('direccion',$fabricante->getDireccion());
        $update->bindValue('email',$fabricante->getEmail());
        $update->bindValue('telefono', $fabricante->getTelefono());
        $update->bindValue('id_categoria',$fabricante->getIdCategoria());

        $update->bindValue('id',$fabricante->getId());

        $update->execute();
    }

    // Método que elimina el registro de un fabricante
    public static function eliminar($id){
        $db=Db::getConnect();
        
        $delete=$db->prepare('DELETE FROM Fabricantes WHERE id=:id');
        $delete->bindValue('id',$id);
        $delete->execute();		
    }
}

?>