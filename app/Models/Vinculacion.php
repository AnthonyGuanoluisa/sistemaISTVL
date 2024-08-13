<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Vinculacion extends Model
{
    protected $table = 'vinculacion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Cedula', 'Empresa', 'Proyecto', 'Periodo', 'Horas', 'Fecha-Inicio', 'Fecha_Fin', 'Carrera', 'Aprobado', 'Total_Horas'];
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


    public function eliminarRegistro($id)
    {
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;
    }
    public function buscarRegistros()
    {
        $query = "SELECT
            vinculacion.id as idVinculacion, 
            vinculacion.Periodo, 
            vinculacion.Fecha_Inicio, 
            vinculacion.Fecha_Fin, 
            vinculacion.Aprobado, 
            vinculacion.Horas, 
            vinculacion.Total_Horas, 
            CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto, 
            empresas.Nombre_empresa, 
            proyectos_vinculacion.Nombre_Proyecto, 
            carreras.Nombre_Carrera,
        	vinculacion.Cedula
        FROM vinculacion 
        INNER JOIN estudiantes ON vinculacion.Cedula = estudiantes.id
        INNER JOIN empresas ON vinculacion.Empresa = empresas.id
        INNER JOIN proyectos_vinculacion ON empresas.id = proyectos_vinculacion.Empresa AND vinculacion.Proyecto = proyectos_vinculacion.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id AND estudiantes.Carrera = carreras.id AND proyectos_vinculacion.Carrera = carreras.id AND vinculacion.Carrera = carreras.id 
        ORDER BY NombreCompleto ASC, vinculacion.Empresa ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistrosPorCarreras($idCarrera)
    {
        $query = "SELECT
        vinculacion.id as idVinculacion, 
        vinculacion.Periodo, 
        vinculacion.Fecha_Inicio, 
        vinculacion.Fecha_Fin, 
        vinculacion.Aprobado, 
        vinculacion.Horas, 
        vinculacion.Total_Horas, 
        CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto, 
        empresas.Nombre_empresa, 
        proyectos_vinculacion.Nombre_Proyecto, 
        carreras.Nombre_Carrera,
        	vinculacion.Cedula
        FROM vinculacion 
        INNER JOIN estudiantes ON vinculacion.Cedula = estudiantes.id
        INNER JOIN empresas ON vinculacion.Empresa = empresas.id
        INNER JOIN proyectos_vinculacion ON empresas.id = proyectos_vinculacion.Empresa AND vinculacion.Proyecto = proyectos_vinculacion.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id AND estudiantes.Carrera = carreras.id AND proyectos_vinculacion.Carrera = carreras.id AND vinculacion.Carrera = carreras.id 
        WHERE vinculacion.Carrera = ? ORDER BY NombreCompleto ASC, vinculacion.Empresa ASC";
        $result = $this->db->query($query, [$idCarrera]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idVinculacion)
    {
     $query = "SELECT
        vinculacion.id as idVinculacion, 
        vinculacion.Periodo, 
        vinculacion.Fecha_Inicio, 
        vinculacion.Fecha_Fin, 
        vinculacion.Aprobado, 
        vinculacion.Horas, 
        vinculacion.Total_Horas, 
        proyectos_vinculacion.Nombre_Proyecto, 
        CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto, 
        vinculacion.Cedula, 
        vinculacion.Carrera, 
        vinculacion.Empresa,
        vinculacion.Proyecto
        FROM
        vinculacion
        INNER JOIN
        proyectos_vinculacion
        ON 
            vinculacion.Proyecto = proyectos_vinculacion.id
        INNER JOIN
        estudiantes
        ON 
            vinculacion.Cedula = estudiantes.id
        WHERE
        vinculacion.id = ?
        ORDER BY
        NombreCompleto ASC, 
        vinculacion.Empresa ASC";

        $result = $this->db->query($query, [$idVinculacion]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function existeUsuarioVin($nombreEstudiante)
    {
     $query = "SELECT
        vinculacion.id as idVinculacion, 
        vinculacion.Cedula, 
        vinculacion.Carrera, 
        vinculacion.Empresa,
        vinculacion.Proyecto
        FROM
        vinculacion
        INNER JOIN
        proyectos_vinculacion
        ON 
            vinculacion.Proyecto = proyectos_vinculacion.id
        
        WHERE
        vinculacion.Cedula = ?";

        $result = $this->db->query($query, [$nombreEstudiante]);
        return $result->getResult() ? $result->getResult() : false;
    }



}