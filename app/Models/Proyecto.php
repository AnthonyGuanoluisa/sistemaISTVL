<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Proyecto extends Model
{
    protected $table = 'proyectos_vinculacion';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Empresa', 'Nombre_Proyecto', 'Carrera', 'Codigo'];
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
            proyectos_vinculacion.id AS idProyecto, 
	        proyectos_vinculacion.Nombre_Proyecto, 
	        proyectos_vinculacion.Codigo, 
	        empresas.Nombre_empresa, 
	        carreras.Nombre_Carrera
        FROM proyectos_vinculacion
	    INNER JOIN empresas ON proyectos_vinculacion.Empresa = empresas.id
	    INNER JOIN carreras ON empresas.Carrera = carreras.id ORDER BY  empresas.Nombre_empresa ASC, proyectos_vinculacion.Nombre_Proyecto ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }
    public function buscarProyectosPorCarrera($carreraUsuario)
    {
        $query = "SELECT
            proyectos_vinculacion.id AS idProyecto, 
            proyectos_vinculacion.Nombre_Proyecto, 
            proyectos_vinculacion.Codigo, 
            empresas.Nombre_empresa, 
            carreras.Nombre_Carrera, 
            empresas.id
        FROM proyectos_vinculacion
        INNER JOIN empresas ON proyectos_vinculacion.Empresa = empresas.id
        INNER JOIN carreras ON empresas.Carrera = carreras.id
        WHERE empresas.Carrera = ? ";
        $result = $this->db->query($query,[$carreraUsuario]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idProyecto)
    {
        $query = "SELECT
            proyectos_vinculacion.id AS idProyecto, 
            proyectos_vinculacion.Empresa AS empresaProyecto, 
            proyectos_vinculacion.Nombre_Proyecto AS nombreProyecto, 
            proyectos_vinculacion.Carrera AS carreraProyecto, 
            proyectos_vinculacion.Codigo AS codigoProyecto
        FROM proyectos_vinculacion
        WHERE  proyectos_vinculacion.id = ?";
        $result = $this->db->query($query,[$idProyecto]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }
    public function buscarRegistroID($idEmpresa)
    {
        $query = "SELECT
            proyectos_vinculacion.id AS idProyecto, 
            proyectos_vinculacion.Empresa AS empresaProyecto, 
            proyectos_vinculacion.Nombre_Proyecto AS nombreProyecto, 
            proyectos_vinculacion.Carrera AS carreraProyecto,
            proyectos_vinculacion.Codigo AS codigoProyecto
        FROM proyectos_vinculacion
        WHERE  proyectos_vinculacion.Empresa = ?";
        $result = $this->db->query($query,[$idEmpresa]);
        return $result->getResult() ? $result->getResult() : []; 
    }
}
