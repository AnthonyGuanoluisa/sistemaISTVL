<?php

namespace App\Models;

use CodeIgniter\Model;


helper('system');

class CertificadoDSW extends Model
{
    protected $table = 'certificado_dsw';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Estudiante', 'Cedula', 'Carrera', 'Empresa_1erP', 'Fecha_Inicio_1erP', 'Fecha_Fin_1erP', 'Horas_1erP', 'Empresa_2erP', 'Fecha_Inicio_2erP', 'Fecha_Fin_2erP', 'Horas_2erP', 'Empresa_Vinculacion', 'Fecha_Inicio_Vinculacion', 'Fecha_Finalizacion_Vinculacion', 'Horas_Vinculacion','Horas_Completadas','NumCerti'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdFieldId  = 'created_id';
    protected $createdField  = 'created_at';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

    public function insertarRegistro($data,$codigoCarrera)
    {
        $ultimoCodigoCarreraQuery = $this->db->table($this->table)
            ->select('NumCerti')
            ->where('Carrera', $data['Carrera'])
            ->orderBy('NumCerti', 'DESC')
            ->limit(1); 
    
        $ultimoCodigoCarrera = $ultimoCodigoCarreraQuery->get()->getFirstRow('array');
    
        $fechaActual = date('Y');
    
        $resetContador = false;
        if (isset($ultimoCodigoCarrera['NumCerti'])) {
            $anioUltimoCodigo = substr($ultimoCodigoCarrera['NumCerti'], 0, 4);
            if ($anioUltimoCodigo!= $fechaActual) {
                $resetContador = true;
            }
        } else {
            $resetContador = true; 
        }
    
        $nuevoCodigoCarrera = $resetContador? 1 : (isset($ultimoCodigoCarrera['NumCerti'])? preg_match('/(\d{3})-CV-/i', $ultimoCodigoCarrera['NumCerti'], $match)? intval($match[1]) + 1 : 1 : 1);
    
        $data['NumCerti'] = sprintf('%s-%03d-CV-%s', $fechaActual, $nuevoCodigoCarrera, $codigoCarrera);
    
        $dataConAuditoria = array_merge($data, getAudith('insert'));
        $builder = $this->db->table($this->table)->insert($dataConAuditoria);
    
        return $builder? $this->db->insertID():false;
    }

    public function editarRegistroDSW($id, $data)
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
        $result = $this->db->table($this->table)->update(array_merge($data, getAudith('edit')), ['Cedula' => $Cedula]);
        return $result ? true : false;
    }

    public function buscarRegistros()
    {
        $query = "SELECT * FROM certificado_dsw ORDER BY certificado_dsw.Estudiante ASC;";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }
    public function buscarRegistrosSIN()
    {
        $query = "SELECT
                certificado_dsw.id AS idCertificados,
                certificado_dsw.Estudiante AS estudianteCertificado, 
                certificado_dsw.Cedula AS cedulaCertificado, 
                certificado_dsw.Carrera AS carreraCertificado, 
                certificado_dsw.Empresa_1erP AS empresaPracticasUno, 
                certificado_dsw.Fecha_Inicio_1erP AS inicioPracticasUno, 
                certificado_dsw.Fecha_Fin_1erP AS finPracticasUno, 
                certificado_dsw.Horas_1erP AS horasPracticasUno, 
                certificado_dsw.Empresa_2erP AS empresaPracticasDos, 
                certificado_dsw.Fecha_Inicio_2erP AS inicioPracticasDos, 
                certificado_dsw.Fecha_Fin_2erP AS finPracticasDos, 
                certificado_dsw.Horas_2erP AS horasPracticasDos, 
                certificado_dsw.Empresa_Vinculacion AS empresaVinculacion, 
                certificado_dsw.Fecha_Inicio_Vinculacion AS inicioVinculacion, 
                certificado_dsw.Fecha_Finalizacion_Vinculacion AS finVinculacion, 
                certificado_dsw.Horas_Vinculacion AS horasVinculacion, 
                certificado_dsw.Horas_Completadas AS horasCompletadas,
                certificado_dsw.NumCerti AS numCerti
            FROM certificado_dsw
            LEFT JOIN certificados_generados cg ON certificado_dsw.Cedula = cg.Cedula
            WHERE cg.Cedula IS NULL
            ORDER BY certificado_dsw.Estudiante ASC;";
    
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }
    public function buscarRegistroPorID($idCertificados)
    {
        $query = "SELECT
            certificado_dsw.id AS idCertificados,
            certificado_dsw.Estudiante AS estudianteCertificado, 
            certificado_dsw.Cedula AS cedulaCertificado, 
            certificado_dsw.Carrera AS carreraCertificado, 
            certificado_dsw.Empresa_1erP AS empresaPracticasUno, 
            certificado_dsw.Fecha_Inicio_1erP AS inicioPracticasUno, 
            certificado_dsw.Fecha_Fin_1erP AS finPracticasUno, 
            certificado_dsw.Horas_1erP AS horasPracticasUno, 
            certificado_dsw.Empresa_2erP AS empresaPracticasDos, 
            certificado_dsw.Fecha_Inicio_2erP AS inicioPracticasDos, 
            certificado_dsw.Fecha_Fin_2erP AS finPracticasDos, 
            certificado_dsw.Horas_2erP AS horasPracticasDos, 
            certificado_dsw.Empresa_Vinculacion AS empresaVinculacion, 
            certificado_dsw.Fecha_Inicio_Vinculacion AS inicioVinculacion, 
            certificado_dsw.Fecha_Finalizacion_Vinculacion AS finVinculacion, 
            certificado_dsw.Horas_Vinculacion AS horasVinculacion, 
            certificado_dsw.Horas_Completadas AS horasCompletadas,
            certificado_dsw.NumCerti AS numCerti
        FROM certificado_dsw
        WHERE certificado_dsw.id = ?";
        $result = $this->db->query($query,[$idCertificados]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    
}
