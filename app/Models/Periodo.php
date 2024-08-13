<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Periodo extends Model{

    protected $table = 'periodos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Ciclo_Academico'];	
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

    public function editarPeriodo($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function eliminarRegistro($id)
    {
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;
    }

    public function buscarPeriodo()
    {
        $query = "SELECT periodos.id AS idPeriodos, periodos.Ciclo_Academico as tipoCiclo FROM periodos ORDER BY periodos.Ciclo_Academico ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarRegistroPorID($idPeriodos)
    {
        $query = "SELECT periodos.id AS idPeriodos, periodos.Ciclo_Academico as tipoCiclo FROM periodos WHERE periodos.id = ?";
        $result = $this->db->query($query,[$idPeriodos]);
        return $result->getResult() ? $result->getResult(): false;
    }
}