<?php

namespace App\Models;

use CodeIgniter\Model;
helper('system');

class Practicas extends Model
{

    protected $table = 'practicas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Cedula', 'Empresa', 'Horas', 'Fecha_Inicio', 'Fecha_Fin', 'Aprobado', 'Total_Horas', 'Carrera', 'Curso','Tutor_Academico'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdFieldId  = 'created_id';
    protected $createdField  = 'created_at';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

    public function insertarRegistro($data)
    {
        $builder = $this->db->table($this->table)->insert(array_merge($data, getAudith('insert')));
        return  $builder ? $this->db->insertID() : false;
    }

    public function editarRegistro($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function editarDSW($id, $data)
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
        practicas.id AS idPracticas,
        practicas.Cedula,
        CONCAT( estudiantes.Nombres, ' ', estudiantes.Apellidos ) AS NombreCompleto,
        practicas.Empresa,
        practicas.Horas,
        practicas.Fecha_Inicio,
        practicas.Fecha_Fin,
        practicas.Aprobado,
        practicas.Total_Horas,
        practicas.Carrera,
        practicas.Curso,
        practicas.Tutor_Academico,
        carreras.Nombre_Carrera 
        FROM
        practicas
        INNER JOIN estudiantes ON practicas.Cedula = estudiantes.id
        INNER JOIN carreras ON estudiantes.Carrera = carreras.id 
        AND practicas.Carrera = carreras.id";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistrosPorCarreras($idCarreras)
    {
        $query = "SELECT
        practicas.id AS idPracticas,
        practicas.Cedula,
        CONCAT( estudiantes.Nombres, ' ', estudiantes.Apellidos ) AS NombreCompleto,
        practicas.Empresa,
        practicas.Horas,
        practicas.Fecha_Inicio,
        practicas.Fecha_Fin,
        practicas.Aprobado,
        practicas.Total_Horas,
        practicas.Carrera,
        practicas.Curso,
        practicas.Tutor_Academico,
        carreras.Nombre_Carrera 
        FROM
        practicas
        INNER JOIN estudiantes ON practicas.Cedula = estudiantes.id
        INNER JOIN carreras ON estudiantes.Carrera = carreras.id 
        AND practicas.Carrera = carreras.id
	
	  WHERE practicas.Carrera = ?";
        $result = $this->db->query($query,[$idCarreras]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function existeUsuarioPrac($nombreEstudiante)
    {
        $query = "SELECT
        practicas.id AS idPracticas,
        practicas.Cedula,
        CONCAT( estudiantes.Nombres, ' ', estudiantes.Apellidos ) AS NombreCompleto,
        practicas.Empresa,
        practicas.Horas,
        practicas.Fecha_Inicio,
        practicas.Fecha_Fin,
        practicas.Aprobado,
        practicas.Total_Horas,
        practicas.Carrera,
        practicas.Curso,
        practicas.Tutor_Academico,
        carreras.Nombre_Carrera 
        FROM
        practicas
        INNER JOIN estudiantes ON practicas.Cedula = estudiantes.id
        INNER JOIN carreras ON estudiantes.Carrera = carreras.id 
        AND practicas.Carrera = carreras.id WHERE practicas.Cedula = ? ORDER BY NombreCompleto ASC";
        $result = $this->db->query($query,[$nombreEstudiante]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idPracticas)
    {
        $query = "SELECT
        practicas.id AS idPracticas, 
        practicas.Cedula, 
        CONCAT( estudiantes.Nombres, ' ', estudiantes.Apellidos ) AS NombreCompleto, 
        practicas.Empresa, 
        practicas.Horas, 
        practicas.Fecha_Inicio, 
        practicas.Fecha_Fin, 
        practicas.Aprobado, 
        practicas.Total_Horas, 
        practicas.Carrera, 
        practicas.Curso, 
        practicas.Tutor_Academico
        FROM
        practicas
        INNER JOIN
        estudiantes
        ON 
        practicas.Cedula = estudiantes.id
	    WHERE practicas.id = ?";
        $result = $this->db->query($query,[$idPracticas]);
        return $result->getResult() ? $result->getResult(): false;
    }
}
