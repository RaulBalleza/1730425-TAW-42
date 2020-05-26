<?php
class Carrera
{

    private $id;
    private $nombre;

    function __construct($id, $nombre)
    {
        $this->setId($id);
        $this->setNombre($nombre);
    }

    // Métodos accesores
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    // Métodos modificadores
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public static function registrar($carrera)
    {
        $db = Db::getConnect();

        $insert = $db->prepare('INSERT INTO Carre (nombre,descripcion,precio_compra,precio_venta,color,id_categoria) VALUES (:nombre,:descripcion,:precio_compra,:precio_venta,:color,:id_categoria)');

        $insert->bindValue('nombre', $carrera->getNombre());

        $insert->execute();
    }
}
