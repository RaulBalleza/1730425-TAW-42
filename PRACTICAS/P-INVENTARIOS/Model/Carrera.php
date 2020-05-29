<?php

class Carrera
{

    // Atributos de la clase
    private $id;
    private $nombre;
    private $id_universidad;
    // Constructor
    function __construct($id, $nombre, $id_universidad)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setUniversidad($id_universidad);
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

    public function getUniversidad()
    {
        return $this->id_universidad;
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


    public function setUniversidad($id_universidad)
    {
        $this->id_universidad = $id_universidad;
    }

    // Operaciones CRUD
    public static function registrar($carrera)
    {
        $db = Db::getConnect();

        $insert = $db->prepare('INSERT INTO Carreras(nombre,id_universidad) VALUES (:nombre,:id_universidad)');

        $insert->bindValue('nombre', $carrera->getNombre());
        $insert->bindValue('id_universidad', $carrera->getUniversidad());

        $insert->execute();
    }

    // Método que recupera los todos registros de la tabla
    public static function obtenerCarreras($id)
    {
        $db = Db::getConnect();
        $carreras = [];

        $select = $db->prepare('SELECT id, nombre,id_universidad FROM Carreras WHERE id_universidad=:id');

        $select->bindValue('id', $id);
        $select->execute();

        foreach ($select->fetchAll() as $carrera) {
            $carreras[] = new Carrera($carrera['id'], $carrera['nombre'], $carrera['id_universidad']);
        }

        return $carreras;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerCarrera($id)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT id, nombre,id_universidad FROM Carreras WHERE id=:id');

        $select->bindValue('id', $id);
        $select->execute();

        $carrerasDb = $select->fetch();

        $carreras = new Carrera($carrerasDb['id'], $carrerasDb['nombre'], $carrerasDb['id_universidad']);

        return $carreras;
    }

    // Método que actualiza la información de una categoría de producto
    public static function actualizar($carreras)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE Carreras SET nombre=:nombre WHERE id=:id');

        $update->bindValue('nombre', $carreras->getNombre());

        $update->bindValue('id', $carreras->getId());

        $update->execute();
    }

    // Método que elimina el registro de una categoría de producto
    public static function eliminar($id)
    {
        $db = Db::getConnect();

        $delete = $db->prepare('DELETE FROM Carreras WHERE id=:id');
        $delete->bindValue('id', $id);
        $delete->execute();
    }
}
