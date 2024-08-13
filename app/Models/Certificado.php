<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Certificado extends Model
{
    protected $table = 'certificados';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Estudiante', 'cedula', 'Carrera', 'Empresa_Practicas', 'Fecha_Inicio_Practicas', 'Fecha_Finalizacion_Practicas', 'Horas_Practicas', 'Empresa_Vinculacion', 'Fecha_Inicio_Vinculacion', 'Fecha_Finalizacion_Vinculacion', 'Horas_Vinculacion','Horas_Completadas','Num_Certificado'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdFieldId  = 'created_id';
    protected $createdField  = 'created_at';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

    public function insertarRegistro($data,$codigoCarrera)
    {
        $ultimoCodigoCarreraQuery = $this->db->table($this->table)
            ->select('Num_Certificado')
            ->where('Carrera', $data['Carrera'])
            ->orderBy('Num_Certificado', 'DESC')
            ->limit(1); 
    
        $ultimoCodigoCarrera = $ultimoCodigoCarreraQuery->get()->getFirstRow('array');
    
        $fechaActual = date('Y');
    
        $resetContador = false;
        if (isset($ultimoCodigoCarrera['Num_Certificado'])) {
            $anioUltimoCodigo = substr($ultimoCodigoCarrera['Num_Certificado'], 0, 4);
            if ($anioUltimoCodigo!= $fechaActual) {
                $resetContador = true;
            }
        } else {
            $resetContador = true; 
        }
    
        $nuevoCodigoCarrera = $resetContador? 1 : (isset($ultimoCodigoCarrera['Num_Certificado'])? preg_match('/(\d{3})-CV-/i', $ultimoCodigoCarrera['Num_Certificado'], $match)? intval($match[1]) + 1 : 1 : 1);
    
        $data['Num_Certificado'] = sprintf('%s-%03d-CV-%s', $fechaActual, $nuevoCodigoCarrera, $codigoCarrera);
    
        $dataConAuditoria = array_merge($data, getAudith('insert'));
        $builder = $this->db->table($this->table)->insert($dataConAuditoria);
    
        return $builder? $this->db->insertID() : false;
    }


    public function editarRegistroGeneral($id, $data)
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
        $query = "SELECT*FROM certificados ORDER BY certificados.Carrera ASC, certificados.Estudiante ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistrosSIN()
    {
        $query = "SELECT
            c.id AS idCertificados, 
            c.Estudiante AS estudianteCertificados, 
            c.cedula AS cedulaCertificados, 
            c.Carrera AS carreraCertificados, 
            c.Empresa_Practicas AS empresaPracticas, 
            c.Fecha_Inicio_Practicas AS inicioPracticas, 
            c.Fecha_Finalizacion_Practicas AS finPracticas, 
            c.Horas_Practicas AS horasPracticas, 
            c.Empresa_Vinculacion AS empresaVinculacion, 
            c.Fecha_Inicio_Vinculacion AS inicioVinculacion, 
            c.Fecha_Finalizacion_Vinculacion AS finVinculacion, 
            c.Horas_Vinculacion AS horasVinculacion,
            c.Horas_Completadas AS horasCompletadas,
            c.Num_Certificado AS numCertificado
        FROM certificados c LEFT JOIN certificados_generados cg ON c.cedula = cg.Cedula
        WHERE cg.Cedula IS NULL ORDER BY c.Carrera ASC, c.Estudiante ASC";

        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idCertificados)
    {
        $query = "SELECT
        certificados.id AS idCertificados, 
        certificados.Estudiante AS estudianteCertificados, 
        certificados.cedula AS cedulaCertificados, 
        certificados.Carrera AS carreraCertificados, 
        certificados.Empresa_Practicas AS empresaPracticas, 
        certificados.Fecha_Inicio_Practicas AS inicioPracticas, 
        certificados.Fecha_Finalizacion_Practicas AS finPracticas, 
        certificados.Horas_Practicas AS horasPracticas, 
        certificados.Empresa_Vinculacion AS empresaVinculacion, 
        certificados.Fecha_Inicio_Vinculacion AS inicioVinculacion, 
        certificados.Fecha_Finalizacion_Vinculacion AS finVinculacion, 
        certificados.Horas_Vinculacion AS horasVinculacion,
        certificados.Horas_Completadas AS horasCompletadas,
        certificados.Num_Certificado AS numCertificado
        FROM certificados
        WHERE certificados.id = ?";
        $result = $this->db->query($query,[$idCertificados]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

   
}
