<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Jornada extends Model{

    protected $table = 'jornadas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Tipo_Jornada'];	
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

    public function editarJornada($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function eliminarRegistro($id)
    {
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;
    }

    public function buscarJornada()
    {
        $query = "SELECT jornadas.id AS idJornada,jornadas.Tipo_Jornada as tipoJornada FROM jornadas ORDER BY jornadas.Tipo_Jornada ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }
    public function buscarRegistroPorID($idJornada)
    {
        $query = "SELECT jornadas.id AS idJornada,jornadas.Tipo_Jornada as tipoJornada FROM jornadas WHERE jornadas.id = ?";
        $result = $this->db->query($query,[$idJornada]);
        return $result->getResult() ? $result->getResult(): false;
    }
}