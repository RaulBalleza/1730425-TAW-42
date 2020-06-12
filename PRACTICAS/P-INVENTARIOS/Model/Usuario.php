<?php 
class Usuario{
    // Atributos de la clase
    private $id;
    private $usuario;
    private $email;
    private $password;
    private $privilegio;

    // Constructor
    function __construct($id,$usuario, $email, $password, $privilegio){
        $this->setId($id);
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPrivilegio($privilegio);
    }

    // Métodos accesores
    public function getId(){
        return $this->id;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getPrivilegio(){
        return $this->privilegio;
    }

    // Métodos modificadores
    public function setId($id){
        $this->id = $id;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setPrivilegio($privilegio){
        $this->privilegio = $privilegio;
    }

    // Operaciones CRUD
    public static function login($usuario){
        $db=Db::getConnect();

        $query=$db->prepare('SELECT usuario,password FROM Usuarios WHERE usuario=:usuario AND password=:password');

        $query->bindValue( 'usuario',$usuario["usuario"] );
        $query->bindValue( 'password',$usuario["password"] );
        $query->execute();

        if ( $query->rowCount() > 0 ){
            $filas = $query->fetch();
            if ($filas["usuario"] == $usuario["usuario"] && $filas["password"] == $usuario["password"]) {
				return true;
			}
        }
        return false;
    }

    public static function obtener($usuario){
        $db=Db::getConnect();

        $query=$db->prepare('SELECT id,usuario,email,password,privilegio FROM Usuarios WHERE usuario=:usuario');

        $query->bindValue( 'usuario', $usuario );
        $query->execute();

        $filas = $query->fetch();

        // Arreglo asociativo para guardar y devolver al controlador los datos de la consulta
        $respuesta = array(
            "id" => $filas['id'],
            "usuario" => $filas['usuario'],
            "email" => $filas['email'],
            "email" => $filas['privilegio']
        );

        return $respuesta;
    }

    public static function registrar($usuario)
  {
    $db = Db::getConnect();

    $insert = $db->prepare('INSERT INTO Usuarios (usuario,password,email,privilegio) VALUES (:usuario,:password,:email,:privilegio)');

    $insert->bindValue('usuario', $usuario->getUsuario());
    $insert->bindValue('password', $usuario->getPassword());
    $insert->bindValue('email', $usuario->getEmail());
    $insert->bindValue('privilegio', $usuario->getPrivilegio());

    $insert->execute();
  }

    public static function obtenerUsuarios()
  {
    $db = Db::getConnect();
    $productos = [];

    $select = $db->query('SELECT * FROM Usuarios');

    foreach ($select->fetchAll() as $usuario) {
      $usuarios[] = new Usuario($usuario['id'],$usuario['usuario'],$usuario['email'], $usuario['password'],$usuario['privilegio']);
    }

    return $usuarios;
  }

  // Método que recupera únicamente un registro de la tabla
  public static function obtenerUsuario($id)
  {
    $db = Db::getConnect();
    $select = $db->prepare('SELECT * FROM Usuarios WHERE id=:id');

    $select->bindValue('id', $id);
    $select->execute();

    $usuarioDb = $select->fetch();

    $usuario = new Usuario($usuarioDb['id'],$usuarioDb['usuario'],$usuarioDb['email'], $usuarioDb['password'],$usuarioDb['privilegio']);
    return $usuario;
  }
}
