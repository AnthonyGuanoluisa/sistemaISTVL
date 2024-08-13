<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombre_Cargo'];	
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

    public function buscarCargos()
    {
        $query = "SELECT cargos.id AS idCargo,cargos.Nombre_Cargo as NombreCargo FROM Cargos ORDER BY cargos.Nombre_Cargo ASC";
        $result = $this->db->query($query);
            return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarRegistroPorID($idCargo)
    {
        $query = "SELECT cargos.id AS idCargo, cargos.Nombre_Cargo as NombreCargo FROM Cargos WHERE cargos.id = ?";
        $result = $this->db->query($query, [$idCargo]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }
}