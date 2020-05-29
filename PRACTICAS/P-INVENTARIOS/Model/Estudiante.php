<?php

class Estudiante
{

    // Atributos de la clase
    private $matricula;
    private $nombre;
    private $promedio;
    private $edad;
    private $id_carrera;

    // Constructor
    function __construct($matricula, $nombre, $promedio, $edad, $id_carrera)
    {
        $this->setMatricula($matricula);
        $this->setNombre($nombre);
        $this->setPromedio($promedio);
        $this->setEdad($edad);
        $this->setCarrera($id_carrera);
    }

    // Métodos accesores
    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPromedio()
    {
        return $this->promedio;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function getCarrera()
    {
        return $this->id_carrera;
    }

    // Métodos modificadores
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPromedio($promedio)
    {
        $this->promedio = $promedio;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    public function setCarrera($id_carrera)
    {
        $this->id_carrera = $id_carrera;
    }

    // Operaciones CRUD
    public static function registrar($estudiante)
    {
        $db = Db::getConnect();

        $insert = $db->prepare('INSERT INTO Estudiantes(matricula,nombre,promedio,edad,id_carrera) VALUES (:matricula,:nombre,:promedio,:edad,:id_carrera)');

        $insert->bindValue('matricula', $estudiante->getMatricula());
        $insert->bindValue('nombre', $estudiante->getNombre());
        $insert->bindValue('promedio', $estudiante->getPromedio());
        $insert->bindValue('edad', $estudiante->getEdad());
        $insert->bindValue('id_carrera', $estudiante->getCarrera());


        $insert->execute();
    }

    // Método que recupera los todos registros de la tabla
    public static function obtenerEstudiantes($id)
    {
        $db = Db::getConnect();
        $estudiantes = [];

        $select = $db->prepare('SELECT matricula,nombre,promedio,edad,id_carrera FROM Estudiantes WHERE id_carrera=:carrera');
        $select->bindValue('carrera', $id);
        $select->execute();
        foreach ($select->fetchAll() as $estudiante) {
            $estudiantes[] = new Estudiante($estudiante['matricula'], $estudiante['nombre'], $estudiante['promedio'], $estudiante['edad'], $estudiante['id_carrera']);
        }

        return $estudiantes;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerEstudiante($matricula)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT matricula,nombre, promedio, edad, id_carrera FROM Estudiantes WHERE matricula=:matricula');

        $select->bindValue('matricula', $matricula);


        $select->execute();

        $estudianteDb = $select->fetch();

        $estudiante = new Estudiante($estudianteDb['matricula'], $estudianteDb['nombre'], $estudianteDb['promedio'], $estudianteDb['edad'], $estudianteDb['id_carrera']);

        return $estudiante;
    }

    // Método que actualiza la información de una categoría de producto
    public static function actualizar($estudiante)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE Estudiantes SET matricula=:matricula,nombre=:nombre, promedio=:promedio, edad=:edad WHERE matricula=:matricula');

        $update->bindValue('matricula', $estudiante->getMatricula());
        $update->bindValue('nombre', $estudiante->getNombre());
        $update->bindValue('promedio', $estudiante->getPromedio());
        $update->bindValue('edad', $estudiante->getEdad());


        $update->execute();
    }

    // Método que elimina el registro de una categoría de producto
    public static function eliminar($matricula)
    {
        $db = Db::getConnect();

        $delete = $db->prepare('DELETE FROM Universidades WHERE matricula=:matricula');
        $delete->bindValue('matricula', $matricula);
        $delete->execute();
    }
}
