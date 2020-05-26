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
    public static function obtenerEstudiantes()
    {
        $db = Db::getConnect();
        $estudiantes = [];

        $select = $db->query('SELECT matricula,nombre,promedio,edad,id_carrera FROM Estudiantes');

        foreach ($select->fetchAll() as $estudiante) {
            $estudiantes[] = new Estudiante($estudiante['matricula'], $estudiante['nombre'], $estudiante['promedio'], $estudiante['edad'], $estudiante['id_carrera']);
        }

        return $estudiantes;
    }

    // Método que recupera únicamente un registro de la tabla
    public static function obtenerUniversidad($matricula)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT matricula, nombre FROM Universidades WHERE matricula=:matricula');

        $select->bindValue('matricula', $matricula);
        $select->execute();

        $universidadDb = $select->fetch();

        $universidad = new Universidad($universidadDb['matricula'], $universidadDb['nombre']);

        return $universidad;
    }

    // Método que actualiza la información de una categoría de producto
    public static function actualizar($universidad)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE Universidades SET nombre=:nombre WHERE matricula=:matricula');

        $update->bindValue('nombre', $universidad->getNombre());

        $update->bindValue('matricula', $universidad->getId());

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
