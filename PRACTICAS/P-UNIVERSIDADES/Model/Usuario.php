<?php 
class Usuario{
    // Atributos de la clase
    private $usuario;
    private $email;
    private $password;
    private $privilegio;

    // Constructor
    function __construct($usuario, $email, $password, $privilegio){
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPrivilegio($privilegio);
    }

    // Métodos accesores
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

        $query=$db->prepare('SELECT usuario,email,password,privilegio FROM Usuarios WHERE usuario=:usuario');

        $query->bindValue( 'usuario', $usuario );
        $query->execute();

        $filas = $query->fetch();

        // Arreglo asociativo para guardar y devolver al controlador los datos de la consulta
        $respuesta = array(
            "usuario" => $filas['usuario'],
            "email" => $filas['email'],
            "email" => $filas['privilegio']
        );

        return $respuesta;
    }
}
?>