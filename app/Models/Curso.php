<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Curso extends Model{

    protected $table = 'cursos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Cursos','Nivel','Ciclo_Academico','Jornada','Carrera'];	
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

    public function buscarCursos()
    {
        $query = "SELECT
        cursos.id AS idCurso, 
        CONCAT(cursos.Cursos, ' / ',niveles.Nivel,' / ', periodos.Ciclo_Academico,' / ',jornadas.Tipo_Jornada) AS Curso,
        CONCAT(cursos.Cursos, ' / ', periodos.Ciclo_Academico) AS Curso,
        cursos.Cursos AS nombreCurso, 
        cursos.Carrera, 
        carreras.Nombre_Carrera, 
        jornadas.Tipo_Jornada, 
        niveles.Nivel, 
        periodos.Ciclo_Academico
        FROM cursos 
        INNER JOIN carreras ON cursos.Carrera = carreras.id
        INNER JOIN jornadas ON cursos.Jornada = jornadas.id
        INNER JOIN niveles ON cursos.Nivel = niveles.id
        INNER JOIN periodos ON cursos.Ciclo_Academico = periodos.id 
        ORDER BY carreras.Nombre_Carrera ASC , cursos.Cursos ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarCursosPorCarrera($idCarrera)
    {
        $query = "SELECT
        cursos.id AS idCurso,
        CONCAT(cursos.Cursos, ' / ',niveles.Nivel,' / ', periodos.Ciclo_Academico,' / ',jornadas.Tipo_Jornada) AS NCurso, 
        CONCAT(cursos.Cursos, ' / ', periodos.Ciclo_Academico) AS Curso,
        cursos.Cursos AS nombreCurso, 
        cursos.Carrera, 
        carreras.Nombre_Carrera, 
        jornadas.Tipo_Jornada, 
        niveles.Nivel, 
        periodos.Ciclo_Academico
        FROM cursos 
        INNER JOIN carreras ON cursos.Carrera = carreras.id
        INNER JOIN jornadas ON cursos.Jornada = jornadas.id
        INNER JOIN niveles ON cursos.Nivel = niveles.id
        INNER JOIN periodos ON cursos.Ciclo_Academico = periodos.id 
        WHERE cursos.Carrera = ?
        ORDER BY carreras.Nombre_Carrera ASC , cursos.Cursos ASC";
        $result = $this->db->query($query, [$idCarrera]);
        return $result->getResult() ? $result->getResult(): false;
    }

    /*public function buscarRegistros()
    {
        $query = " SELECT*FROM usuarios 
        INNER JOIN carreras ON usuarios.Carrera = carreras.id 
        INNER JOIN cargos ON usuarios.Cargo = cargos.id";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }*/

    public function buscarRegistroPorID($idCurso)
    {
        $query = "SELECT
        cursos.id AS idCurso, 
        cursos.Cursos AS nombreCurso,
        cursos.Jornada AS jornadaCurso, 
        cursos.Nivel AS nivelCurso, 
        cursos.Ciclo_Academico AS cicloCurso,
        cursos.Carrera AS carreraCurso
        FROM
        cursos WHERE cursos.id = $idCurso ";
        $result = $this->db->query($query,[$idCurso]);
        return $result->getResult() ? $result->getResult(): false;
    }


}