<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class InformacionCertificado extends Model
{
    protected $table = 'informacion_certificados';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Rector_Institucional', 'Cedula_Rector', 'Encargado_Certificacion', 'Cedula_Encargado','Fecha'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

    public function editarRegistroInfo($id, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['id' => $id]);
        return $result ? true : false;
    }

    public function buscarRegistros()
    {
        $query = "SELECT*FROM informacion_certificados";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idInformacion)
    {
        $query = "SELECT
            informacion_certificados.id AS idInformacion, 
            informacion_certificados.Rector_Institucional AS rector, 
            informacion_certificados.Cedula_Rector AS cedulaRector, 
            informacion_certificados.Encargado_Certificacion AS encargado, 
            informacion_certificados.Cedula_Encargado AS cedulaEncargado,
            informacion_certificados.Fecha AS fechaCertificacion
        FROM informacion_certificados
        WHERE informacion_certificados.id = ?";
        $result = $this->db->query($query,[$idInformacion]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }
}
