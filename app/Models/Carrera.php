<?php

namespace App\Models;

use CodeIgniter\Model;

helper('system');

class Carrera extends Model
{

    protected $table = 'carreras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombre_Carrera, Codigo'];
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

    public function buscarCarreras()
    {
        $query = "SELECT 
            carreras.id AS idCarrera, 
            carreras.Nombre_Carrera as NombreCarrera, 
            Codigo As codigoCarrera
            FROM carreras 
            ORDER BY carreras.Nombre_Carrera ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarCarrerasParaCursos()
    {
        $query = "SELECT 
            carreras.id AS idCarrera, 
            carreras.Nombre_Carrera as NombreCarrera, 
            Codigo As codigoCarrera
            FROM carreras 
            WHERE carreras.Nombre_Carrera != 'COORDINACIÓN'
            ORDER BY carreras.Nombre_Carrera ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }


    public function buscarRegistroPorID($idCarrera)
    {
        $query = "SELECT
        carreras.id AS idCarrera, 
        carreras.Nombre_Carrera as NombreCarrera,
        Codigo As codigoCarrera
        FROM carreras
        WHERE carreras.id = ?";
        $result = $this->db->query($query, [$idCarrera]);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarNombreCarreraPorID($idCarrera)
    {
        $query = "SELECT
            carreras.id AS idCarrera, 
            carreras.Nombre_Carrera AS NombreCarrera
        FROM carreras
        WHERE carreras.id = ?";
        
        $result = $this->db->query($query, [$idCarrera]);
        
        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            return $row->NombreCarrera;
        } else {
            return false;
        }
    }

    public function CodigoCarrera($Carrera)
    {
        $query = "SELECT
            carreras.id AS idCarrera, 
            carreras.Nombre_Carrera AS NombreCarrera,
            Codigo As codigoCarrera
        FROM carreras
        WHERE carreras.Nombre_Carrera = ?";
        
        $result = $this->db->query($query, [$Carrera]);
        
        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            return $row->codigoCarrera;
        } else {
            return false;
        }
    }

    public function idCarrera($Carrera)
    {
        $query = "SELECT
            carreras.id AS idCarrera, 
            carreras.Nombre_Carrera AS NombreCarrera,
            Codigo As codigoCarrera
        FROM carreras
        WHERE carreras.Nombre_Carrera = ?";
        
        $result = $this->db->query($query, [$Carrera]);
        
        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            return $row->idCarrera;
        } else {
            return false;
        }
    }
}
