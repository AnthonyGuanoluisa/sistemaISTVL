<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Tutor extends Model
{
    protected $table = 'tutores';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombres', 'Apellidos', 'Direccion', 'Telefono', 'Correo', 'Carrera','Vigente'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $createdByField = 'created_id';
    protected $updatedByField = 'updated_id';

    public function insertarRegistro($data)
    {
        $builder = $this->db->table($this->table)->insert(array_merge($data, getAudith('insert')));
        return $builder ? $this->db->insertID() : false;
    }

    public function editarRegistro($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function eliminarRegistro($id)
    {
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;
    }

    public function buscarRegistros()
    {
        $query = "SELECT
        tutores.id AS cedulaTutor, 
        tutores.Nombres, 
        tutores.Apellidos, 
        tutores.Direccion, 
        tutores.Telefono, 
        tutores.Correo, 
        carreras.Nombre_Carrera, 
        jornadas.Tipo_Jornada, 
        tutores.Carrera,
        tutores.Vigente
        FROM tutores
        INNER JOIN jornadas ON tutores.Jornada = jornadas.id
        INNER JOIN carreras ON tutores.Carrera = carreras.id ORDER BY tutores.Nombres ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistrosPorCarrera($idCarrera)
    {
        $query = "SELECT
        tutores.id AS cedulaTutor, 
        tutores.Nombres, 
        CONCAT(tutores.Nombres, ' ', tutores.Apellidos) AS NombreTutor, 
        tutores.Apellidos, 
        tutores.Direccion, 
        tutores.Telefono, 
        tutores.Correo, 
        carreras.Nombre_Carrera, 
        jornadas.Tipo_Jornada, 
        tutores.Carrera,
        tutores.Vigente
        FROM tutores INNER JOIN jornadas
        ON tutores.Jornada = jornadas.id
        INNER JOIN	carreras ON	tutores.Carrera = carreras.id
        WHERE tutores.Carrera = ? ORDER BY tutores.Nombres ASC";
        $result = $this->db->query($query, [$idCarrera]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($cedulaTutor)
    {
        $query = "SELECT
            tutores.id As cedulaTutor, 
            tutores.Nombres As nombreTutor, 
            tutores.Apellidos As apellidoTutor, 
            tutores.Direccion As direccionTutor, 
            tutores.Telefono As telefonoTutor, 
            tutores.Correo As correoTutor, 
            tutores.Carrera As carreraTutor,
            tutores.Jornada As jornadaTutor,
            tutores.Vigente as vigenciaTutor
        FROM tutores
        WHERE tutores.id = ?";
        $result = $this->db->query($query, [$cedulaTutor]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarTutorPorCarrera($carreraUsuario)
    {
        $query = "SELECT
            tutores.id As cedulaTutor, 
            tutores.Nombres, 
            tutores.Apellidos, 
            CONCAT(tutores.Nombres, ' ', tutores.Apellidos) AS NombreCompleto,
            tutores.Direccion, 
            tutores.Telefono, 
            tutores.Correo, 
            tutores.Vigente,
            carreras.Nombre_Carrera, 
            jornadas.Tipo_Jornada
        FROM tutores
        INNER JOIN jornadas ON tutores.Jornada = jornadas.id
        INNER JOIN carreras ON tutores.Carrera = carreras.id
        WHERE carreras.id = ? and  tutores.Vigente = 'SI'";
        $result = $this->db->query($query, [$carreraUsuario]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarTutoresPorCarrera($carreraUsuario)
    {
        $query = "SELECT
            tutores.id As cedulaTutor, 
            tutores.Nombres, 
            tutores.Apellidos, 
            CONCAT(tutores.Nombres, ' ', tutores.Apellidos) AS NombreCompleto,
            tutores.Direccion, 
            tutores.Telefono, 
            tutores.Correo, 
            tutores.Vigente,
            carreras.Nombre_Carrera, 
            jornadas.Tipo_Jornada
        FROM tutores
        INNER JOIN jornadas ON tutores.Jornada = jornadas.id
        INNER JOIN carreras ON tutores.Carrera = carreras.id
        WHERE carreras.id = ? ";
        $result = $this->db->query($query, [$carreraUsuario]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarTutorDSW()
    {
        $query = "SELECT
        tutores.id AS cedulaTutor, 
        CONCAT(tutores.Nombres, ' ', tutores.Apellidos) AS NombreCompleto,
        tutores.Direccion, 
        tutores.Telefono, 
        tutores.Correo, 
        carreras.Nombre_Carrera, 
        jornadas.Tipo_Jornada, 
        tutores.Carrera,
        tutores.Vigente
        FROM tutores
        INNER JOIN jornadas ON tutores.Jornada = jornadas.id
        INNER JOIN carreras ON tutores.Carrera = carreras.id 
        WHERE carreras.Nombre_Carrera = 'DESARROLLO DE SOFTWARE' and  tutores.Vigente = 'SI' ORDER BY tutores.Nombres ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }
}
