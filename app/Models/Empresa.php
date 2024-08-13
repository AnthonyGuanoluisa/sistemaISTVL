<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');
class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombre_empresa', 'Encargado', 'Ruc_Empresa', 'Direccion', 'Correo_Empresa', 'Telefono', 'Fecha_Convenio', 'Fecha_Caducidad_Convenio', 'Cupos', 'Asignacion', 'Carrera', 'Codigo'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdFieldId  = 'created_id';
    protected $createdField  = 'created_at';
    protected $updatedFieldId  = 'updated_id';
    protected $updatedField  = 'updated_at';

    public function insertarRegistro($data)
    {
        $builder = $this->db->table($this->table)->insert(array_merge($data, getAudith('insert')));
        return  $builder ? $this->db->insertID() : false;
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

    public function buscarRegistros()
    {
        $query = "SELECT
        empresas.id, 
        empresas.Nombre_empresa, 
        empresas.Encargado, 
        empresas.Ruc_Empresa, 
        empresas.Direccion, 
        empresas.Correo_Empresa, 
        empresas.Telefono, 
        empresas.Fecha_Convenio,
        empresas.Fecha_Caducidad_Convenio, 
        empresas.Cupos, 
        empresas.Asignacion, 
        asignacion_empresa.`Nombre_Asignación`, 
        empresas.Carrera, 
        carreras.Nombre_Carrera, 
        empresas.Codigo
        FROM empresas INNER JOIN asignacion_empresa
        ON empresas.Asignacion = asignacion_empresa.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id
        ORDER BY asignacion_empresa.`Nombre_Asignación` ASC, carreras.Nombre_Carrera ASC , empresas.Nombre_empresa ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idEmpresa)
    {
        $query = "SELECT
            empresas.id AS idEmpresa, 
            empresas.Nombre_empresa AS nombreEmpresa, 
            empresas.Encargado AS nombreEncargado, 
            empresas.Ruc_Empresa AS rucEmpresa, 
            empresas.Direccion AS directEmpresa, 
            empresas.Correo_Empresa AS correoEmpresa, 
            empresas.Telefono AS teleEmpresa, 
            empresas.Fecha_Convenio AS convEmpresa, 
            empresas.Fecha_Caducidad_Convenio AS caduEmpresa, 
            empresas.Cupos AS cuposEmpresa, 
            empresas.Asignacion AS asignacionEmpresa,
            empresas.Carrera As carreraEmpresa,
            empresas.Codigo As codigoEmpresa
        FROM empresas 
        WHERE empresas.id = ? ";
        $result = $this->db->query($query, [$idEmpresa]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarEmpresasPorCarrerayAsignacion($cargoUsuario, $carreraUsuario)
    {
        $query = "SELECT
            empresas.id,
            empresas.Nombre_empresa, 
            empresas.Encargado,
            empresas.Ruc_Empresa, 
            empresas.Direccion, 
            empresas.Correo_Empresa, 
            empresas.Telefono, 
            empresas.Fecha_Convenio, 
            empresas.Fecha_Caducidad_Convenio, 
            empresas.Cupos, 
            empresas.Codigo,
            asignacion_empresa.`Nombre_Asignación`, 
            carreras.Nombre_Carrera
        FROM empresas
        INNER JOIN asignacion_empresa ON empresas.Asignacion = asignacion_empresa.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id
        WHERE empresas.Asignacion = ? and empresas.Carrera = ?
        ORDER BY asignacion_empresa.`Nombre_Asignación` ASC, empresas.Nombre_empresa ASC ";
        $result = $this->db->query($query, [$cargoUsuario, $carreraUsuario]);
        return $result->getResult() ? $result->getResult() : false;
    }
    public function buscarEmpresasPorCarrerayAsignacionParaListado($cargoUsuario, $carreraUsuario, $formatted_date)
    {
        $query = "SELECT
                    empresas.id as idEmpresa,
                    empresas.Nombre_empresa AS nombreEmpresa,
                    empresas.Encargado, 
                    empresas.Ruc_Empresa, 
                    empresas.Direccion, 
                    empresas.Correo_Empresa, 
                    empresas.Telefono, 
                    empresas.Fecha_Convenio, 
                    empresas.Fecha_Caducidad_Convenio, 
                    empresas.Cupos, 
                    empresas.Codigo,
                    asignacion_empresa.Nombre_Asignación, 
                    carreras.Nombre_Carrera
                FROM empresas
                INNER JOIN asignacion_empresa ON empresas.Asignacion = asignacion_empresa.id
                INNER JOIN carreras ON empresas.Carrera = carreras.id
                WHERE empresas.Asignacion = ? 
                    AND empresas.Carrera = ? 
                    AND ? < empresas.Fecha_Caducidad_Convenio ";
        $result = $this->db->query($query, [$cargoUsuario, $carreraUsuario, $formatted_date]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarEmpresasPorAsignacionNombre($Asignacion)
    {
        $query = "SELECT
            empresas.id, 
            empresas.Nombre_empresa, 
            empresas.Encargado, 
            empresas.Ruc_Empresa, 
            empresas.Direccion, 
            empresas.Correo_Empresa, 
            empresas.Telefono, 
            empresas.Fecha_Convenio, 
            empresas.Fecha_Caducidad_Convenio, 
            empresas.Cupos, 
            carreras.Nombre_Carrera, 
            empresas.Codigo, 
            asignacion_empresa.`Nombre_Asignación`
        FROM empresas
        INNER JOIN asignacion_empresa ON empresas.Asignacion = asignacion_empresa.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id
        WHERE asignacion_empresa.`Nombre_Asignación` = ? 
        ORDER BY carreras.Nombre_Carrera ASC, empresas.Nombre_empresa ASC";
        $result = $this->db->query($query, [$Asignacion]);
        return $result->getResult() ? $result->getResult() : false;
    }


    public function buscarEmpresasPorAsignacion($Asignacion)
    {
        $query = "SELECT
            empresas.id, 
            empresas.Nombre_empresa, 
            empresas.Encargado, 
            empresas.Ruc_Empresa, 
            empresas.Direccion, 
            empresas.Correo_Empresa, 
            empresas.Telefono, 
            empresas.Fecha_Convenio, 
            empresas.Fecha_Caducidad_Convenio, 
            empresas.Cupos, 
            carreras.Nombre_Carrera, 
            empresas.Codigo, 
            asignacion_empresa.`Nombre_Asignación`
        FROM empresas
        INNER JOIN asignacion_empresa ON empresas.Asignacion = asignacion_empresa.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id
        WHERE empresas.Asignacion = ? 
        ORDER BY carreras.Nombre_Carrera ASC, empresas.Nombre_empresa ASC";
        $result = $this->db->query($query, [$Asignacion]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function verificarCupos($nombreEmpresa, $asignacion, $carrera)
    { 
        $builder = $this->db->table($this->table);
        $empresa = $builder->where(['Nombre_empresa' => $nombreEmpresa, 'Asignacion' => $asignacion, 'Carrera'=>$carrera])->get()->getRow();

        return $empresa ? $empresa->Cupos : 0;
    }


    public function restarCupo($nombreEmpresa, $asignacion, $carrera)
    {
        $builder = $this->db->table($this->table);
        $empresa = $builder->where(['Nombre_empresa' => $nombreEmpresa, 'Asignacion' => $asignacion, 'Carrera'=>$carrera])->get()->getRow();

        if ($empresa) {
            $nuevosCupos = $empresa->Cupos - 1;
            if ($nuevosCupos < 0) {
                $nuevosCupos = 0;
            }

            $builder->where(['Nombre_empresa' => $nombreEmpresa, 'Asignacion' => $asignacion, 'Carrera'=>$carrera])
                    ->update(['Cupos' => $nuevosCupos]);
        }
    }

    public function sumarCupo($nombreEmpresa, $asignacion, $carrera)
    {
        $builder = $this->db->table($this->table);
        $empresa = $builder->where(['Nombre_empresa' => $nombreEmpresa, 'Asignacion' => $asignacion, 'Carrera'=>$carrera])->get()->getRow();

        if ($empresa) {
            $nuevosCupos = $empresa->Cupos + 1;

            $builder->where(['Nombre_empresa' => $nombreEmpresa, 'Asignacion' => $asignacion, 'Carrera'=>$carrera])
                    ->update(['Cupos' => $nuevosCupos]);
        }
    }


        
    public function buscarEmpresaPorCarreraPracticas($idCarrera,$formatted_date,$idAsignacion)
    {
        $query = "SELECT
            empresas.id AS idEmpresa, 
            empresas.Nombre_empresa AS nombreEmpresa, 
            empresas.Encargado AS nombreEncargado, 
            empresas.Ruc_Empresa AS rucEmpresa, 
            empresas.Direccion AS directEmpresa, 
            empresas.Correo_Empresa AS correoEmpresa, 
            empresas.Telefono AS teleEmpresa, 
            empresas.Fecha_Convenio AS convEmpresa, 
            empresas.Fecha_Caducidad_Convenio AS caduEmpresa, 
            empresas.Cupos AS cuposEmpresa, 
            empresas.Asignacion AS asignacionEmpresa,
            empresas.Carrera As carreraEmpresa,
            empresas.Codigo As codigoEmpresa
        FROM empresas 
        WHERE empresas.Carrera = ? AND ? < empresas.Fecha_Caducidad_Convenio and empresas.Asignacion = ?";
        $result = $this->db->query($query,[$idCarrera,$formatted_date,$idAsignacion]);
        return $result->getResult() ? $result->getResult() : []; 
    }

   
    public function buscarEmpresaCarreraVinculacion($idCarrera,$formatted_date,$idAsignacion)
    {
        $query = "SELECT
            empresas.id AS idEmpresa, 
            empresas.Nombre_empresa AS nombreEmpresa, 
            empresas.Encargado AS nombreEncargado, 
            empresas.Ruc_Empresa AS rucEmpresa, 
            empresas.Direccion AS directEmpresa, 
            empresas.Correo_Empresa AS correoEmpresa, 
            empresas.Telefono AS teleEmpresa, 
            empresas.Fecha_Convenio AS convEmpresa, 
            empresas.Fecha_Caducidad_Convenio AS caduEmpresa, 
            empresas.Cupos AS cuposEmpresa, 
            empresas.Asignacion AS asignacionEmpresa,
            empresas.Carrera As carreraEmpresa,
            empresas.Codigo As codigoEmpresa
        FROM empresas 
        WHERE empresas.Carrera = ? AND ? < empresas.Fecha_Caducidad_Convenio and empresas.Asignacion = ?";
        $result = $this->db->query($query,[$idCarrera,$formatted_date,$idAsignacion]);
        return $result->getResult() ? $result->getResult() : false; 
    }

    public function buscarEmpresaDSW($formatted_date,$idAsignacion)
    {
        $query = "SELECT
        empresas.id AS idEmpresa, 
        empresas.Nombre_empresa AS nombreEmpresa, 
        empresas.Encargado AS nombreEncargado, 
        empresas.Ruc_Empresa AS rucEmpresa, 
        empresas.Direccion AS directEmpresa, 
        empresas.Correo_Empresa AS correoEmpresa, 
        empresas.Telefono AS teleEmpresa, 
        empresas.Fecha_Convenio AS convEmpresa, 
        empresas.Fecha_Caducidad_Convenio AS caduEmpresa, 
        empresas.Cupos AS cuposEmpresa, 
        empresas.Asignacion AS asignacionEmpresa, 
        empresas.Carrera AS carreraEmpresa, 
        empresas.Codigo AS codigoEmpresa, 
        carreras.Nombre_Carrera
        FROM
            empresas
            INNER JOIN
            carreras
            ON 
                empresas.Carrera = carreras.id
        WHERE
        carreras.Nombre_Carrera = 'DESARROLLO DE SOFTWARE' AND ? < empresas.Fecha_Caducidad_Convenio and empresas.Asignacion = ?";
        $result = $this->db->query($query,[$formatted_date,$idAsignacion]);
        return $result->getResult() ? $result->getResult() : []; 
    }

    public function nombreEmpresaID($idEmpresa)
    {
        $query = "SELECT
            empresas.Nombre_empresa AS nombreEmpresa
        FROM empresas 
        WHERE empresas.id = ?";
        
        $result = $this->db->query($query, [$idEmpresa]);
        
        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            return $row->nombreEmpresa;
        } else {
            return false;
        }
    }

}
