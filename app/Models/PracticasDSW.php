<?php

namespace App\Models;
use CodeIgniter\Model;

class PracticasDSW extends Model{

    protected $table = 'practicas_dsw';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Cedula', 'Carrera','Empresa', 'Horas', 'Fecha_Inicio','Fecha_Fin','Tutor_Academico','Curso','Horas_Cum1','Terminado','Empresa2', 'Horas2', 'Fecha_Inicio2','Fecha_Fin2','Tutor_Academico2','Curso2','Horas_Cum2','Terminado2'];	
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

    public function editarDSW($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;		
    }

    public function eliminarRegistro($id){
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;			
    }

    public function buscarRegistros()
    {
        $builder = $this->db->table($this->table);
        $result = $builder->get();
        return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarEstudiantePracticaDSW()
    {
        $query = "SELECT
        practicas_dsw.id AS idPracticasDSW,  
        practicas_dsw.Cedula, 
        CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto, 
        practicas_dsw.Empresa, 
        practicas_dsw.Horas, 
        practicas_dsw.Fecha_Inicio, 
        practicas_dsw.Fecha_Fin, 
        practicas_dsw.Tutor_Academico, 
        practicas_dsw.Curso, 
        practicas_dsw.Terminado, 
        practicas_dsw.Empresa2, 
        practicas_dsw.Horas2, 
        practicas_dsw.Fecha_Inicio2, 
        practicas_dsw.Fecha_Fin2, 
        practicas_dsw.Tutor_Academico2, 
        practicas_dsw.Curso2, 
        practicas_dsw.Carrera, 
        practicas_dsw.Terminado2
        FROM practicas_dsw
        INNER JOIN estudiantes ON practicas_dsw.Cedula = estudiantes.id";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarRegistroPorID($idPracticasDSW)
    {
        $query = "SELECT
            practicas_dsw.id AS idPracticasDSW, 
            practicas_dsw.Cedula, 
            CONCAT(estudiantes.Nombres, ' ', estudiantes.Apellidos) AS NombreCompleto, 
            practicas_dsw.Empresa, 
            practicas_dsw.Horas, 
            practicas_dsw.Fecha_Inicio, 
            practicas_dsw.Fecha_Fin, 
            practicas_dsw.Tutor_Academico, 
            practicas_dsw.Curso, 
            practicas_dsw.Terminado, 
            practicas_dsw.Empresa2, 
            practicas_dsw.Horas2, 
            practicas_dsw.Fecha_Inicio2, 
            practicas_dsw.Fecha_Fin2, 
            practicas_dsw.Tutor_Academico2, 
            practicas_dsw.Curso2, 
            practicas_dsw.Carrera, 
            practicas_dsw.Terminado2,  
            practicas_dsw.Horas_Cum1, 
            practicas_dsw.Horas_Cum2
        FROM practicas_dsw
        INNER JOIN estudiantes ON practicas_dsw.Cedula = estudiantes.id 
        where practicas_dsw.id = ?";
        $result = $this->db->query($query,[$idPracticasDSW]);
        return $result->getResult() ? $result->getResult(): false;
    }

    public function existeUsuarioPracDSW($nombreEstudiante)
    {
        $query = "SELECT
            practicas_dsw.id AS idPracticasDSW, 
            practicas_dsw.Cedula, 
            practicas_dsw.Empresa
        FROM practicas_dsw
        where practicas_dsw.Cedula = ?";
        $result = $this->db->query($query,[$nombreEstudiante]);
        return $result->getResult() ? $result->getResult(): false;
    }
}