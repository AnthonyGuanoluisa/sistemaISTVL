<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombres', 'Apellidos', 'Sexo', 'correo', 'telefono', 'Ciclo_Academico', 'Carrera', 'Jornada'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdFieldId  = 'created_id';
    protected $createdField  = 'created_at';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

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
            estudiantes.id, 
            estudiantes.Nombres, 
            estudiantes.Apellidos, 
            estudiantes.Sexo, 
            estudiantes.correo, 
            estudiantes.telefono, 
            carreras.Nombre_Carrera, 
            periodos.Ciclo_Academico, 
            jornadas.Tipo_Jornada
        FROM estudiantes
        INNER JOIN carreras ON estudiantes.Carrera = carreras.id
        INNER JOIN periodos ON estudiantes.Ciclo_Academico = periodos.id
        INNER JOIN jornadas ON estudiantes.Jornada = jornadas.id
        ORDER BY carreras.Nombre_Carrera ASC, estudiantes.Nombres ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }
    
    public function buscarRegistroPorID($cedulaEstudiante)
    {
        $query = " SELECT
            estudiantes.id AS cedulaEstudiante, 
            estudiantes.Nombres AS nombresEstudiante, 
            estudiantes.Apellidos AS apellidosEstudiante, 
            estudiantes.Sexo AS sexoEstudiante, 
            estudiantes.Ciclo_Academico AS cicloEstudinte, 
            estudiantes.Carrera AS carreraEstudiante, 
            estudiantes.Jornada AS jornadaEstudiante,
            estudiantes.correo AS correoEstudiante, 
            estudiantes.telefono AS telefonoEstudiante
        FROM estudiantes  
        WHERE estudiantes.id = ? ";
        $result = $this->db->query($query, [$cedulaEstudiante]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarEstudiantePorCarrera($idCarrera)
    {
        $query = "SELECT
            estudiantes.id, 
            CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto,
            estudiantes.Sexo, 
            estudiantes.correo, 
            estudiantes.telefono, 
            carreras.Nombre_Carrera, 
            periodos.Ciclo_Academico, 
            jornadas.Tipo_Jornada
        FROM estudiantes
            INNER JOIN carreras ON estudiantes.Carrera = carreras.id
            INNER JOIN periodos ON estudiantes.Ciclo_Academico = periodos.id
            INNER JOIN jornadas ON estudiantes.Jornada = jornadas.id
        WHERE carreras.id = ? ORDER BY estudiantes.Nombres ASC ";
        $result = $this->db->query($query,[$idCarrera]);
        return $result->getResult() ? $result->getResult() : []; 
    }

    public function buscarEstudianteDSW()
    {
        $query = "SELECT
            estudiantes.id,
            CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto,
            estudiantes.Sexo, 
            estudiantes.correo, 
            estudiantes.telefono, 
            carreras.Nombre_Carrera, 
            periodos.Ciclo_Academico, 
            jornadas.Tipo_Jornada
        FROM estudiantes
            INNER JOIN carreras ON estudiantes.Carrera = carreras.id
            INNER JOIN periodos ON estudiantes.Ciclo_Academico = periodos.id
            INNER JOIN jornadas ON estudiantes.Jornada = jornadas.id
        WHERE carreras.Nombre_Carrera = 'DESARROLLO DE SOFTWARE' ORDER BY estudiantes.Nombres ASC ";
         $result = $this->db->query($query);
         return $result->getResult() ? $result->getResult() : false;
    }

}
