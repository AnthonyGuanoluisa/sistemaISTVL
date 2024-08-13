<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class CertificadosGenerados extends Model
{
    protected $table = 'certificados_generados';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Estudiante', 'Cedula', 'Carrera', 'idCerti','Num_Certificado'];
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

    public function actualizarRegistro($Cedula, $data)
    {
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['cedula' => $Cedula]);
        return $result ? true : false;
    }

    public function buscarRegistros()
    {
        $query = "SELECT
        certificados_generados.id AS idCertificados, 
        certificados_generados.Estudiante AS estudianteCertificados, 
        certificados_generados.Cedula AS cedulaCertificados, 
        certificados_generados.Carrera AS carreraCertificados,
        certificados_generados.idCerti AS idCerti
        FROM certificados_generados
        WHERE certificados_generados.Carrera != 'Desarrollo de software'
        ORDER BY certificados_generados.Carrera ASC, certificados_generados.Estudiante ASC";
        
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

   
    
    public function buscarRegistrosDSW()
    {
        $query = "SELECT
        certificados_generados.id AS idCertificadosDSW,
        certificados_generados.Estudiante AS estudianteCertificadosDSW,
        certificados_generados.Cedula AS cedulaCertificadosDSW,
        certificados_generados.Carrera AS carreraCertificadosDSW,
        certificados_generados.idCerti AS idCertiDSW
        FROM certificados_generados
        WHERE certificados_generados.Carrera = 'Desarrollo de software'
        ORDER BY certificados_generados.Carrera ASC, certificados_generados.Estudiante ASC;";
        
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idCertificados)
    {
        $query = "SELECT
        certificados_generados.id AS idCertificados, 
        certificados_generados.Estudiante AS estudianteCertificados, 
        certificados_generados.Cedula AS cedulaCertificados, 
        certificados_generados.Carrera AS carreraCertificados,
        certificados_generados.idCerti AS idCerti,
        FROM certificados_generados
        WHERE certificados_generados.id = ?";
        $result = $this->db->query($query,[$idCertificados]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarRegistroPorCedula($cedulaCertificado)
{
    $query = "SELECT * FROM certificados_generados WHERE Cedula =?";
    $result = $this->db->query($query, [$cedulaCertificado]);
    return $result->getResult();
}
}

