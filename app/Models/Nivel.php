<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Nivel extends Model{

    protected $table = 'niveles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nivel'];	
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

    public function editarNivel($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function eliminarRegistro($id)
    {
        $result = $this->db->table($this->table)->delete(['id' => $id]);
        return $result ? true : false;
    }
    
    public function buscarNivel()
    {
        $query = "SELECT niveles.id AS idNivel,niveles.Nivel as nombreNivel FROM niveles";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }
    public function buscarRegistroPorID($idNivel)
    {
        $query = "SELECT niveles.id AS idNivel,niveles.Nivel as nombreNivel FROM niveles WHERE niveles.id = ? ";
        $result = $this->db->query($query,[$idNivel]);
        return $result->getResult() ? $result->getResult(): false;
    }
}