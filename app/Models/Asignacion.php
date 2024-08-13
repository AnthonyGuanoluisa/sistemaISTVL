<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Asignacion extends Model
{

    protected $table = 'asignacion_empresa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombre_Asignación'];	
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

    public function buscarAsignacion()
    {
        $query = "SELECT asignacion_empresa.id AS idAsignacion,asignacion_empresa.Nombre_Asignación as NombreAsignacion FROM asignacion_empresa ORDER BY asignacion_empresa.Nombre_Asignación ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult(): false;
    }

    public function buscarRegistroPorID($idAsignacion)
    {
        $query = "SELECT asignacion_empresa.id AS idAsignacion,asignacion_empresa.Nombre_Asignación as NombreAsignacion FROM asignacion_empresa WHERE asignacion_empresa.id = ?";
        $result = $this->db->query($query, [$idAsignacion]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarIdAsignacion($nombreAsignacion)
{
    $query = "SELECT 
        asignacion_empresa.id AS idAsignacion,
        asignacion_empresa.Nombre_Asignación
    FROM asignacion_empresa 
    WHERE asignacion_empresa.Nombre_Asignación = ?";
    
    $result = $this->db->query($query, [$nombreAsignacion]);
    
    // Obtener el resultado y retornar solo el idAsignacion
    if ($result->getNumRows() > 0) {
        $row = $result->getRow();
        return $row->idAsignacion;
    } else {
        return false;
    }
}

    
}