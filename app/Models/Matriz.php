<?php

namespace App\Models;
use CodeIgniter\Model;
helper('system');

class Matriz extends Model
{
    protected $table = 'matriz';
    protected $primaryKey = 'id';
    protected $allowedFields = ['zona','Provincia','Instituto','Convenio','Carrera', 'Beneficiarios_carrera', 'Beneficiarios_convenio', 'Aprovacion', 'Empresa', 'Naturaleza_empresa', 'Tipo_empresa', 'Representante_empresa', 'Direccion_empresa', 'Correo_empresa', 'Telefono_empresa', 'Sector_Productivo', 'Fecha_suscripcion', 'Fecha_terminacion'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $createdByField = 'created_id';
    protected $updatedByField = 'updated_id';

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

    public function buscarRegistros()
    {
        $query = " SELECT * FROM matriz ORDER BY matriz.zona ASC, matriz.Carrera ASC,Empresa ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idMatriz)
    {
        $query = "SELECT
            matriz.id AS idMatriz, 
            matriz.zona AS zonaMatriz, 
            matriz.Provincia AS provinciaMatriz, 
            matriz.Instituto AS institutoMatriz, 
            matriz.Convenio AS convenioMatriz, 
            matriz.Carrera AS carreraMatriz, 
            matriz.Beneficiarios_carrera AS beneficiariosCarrera, 
            matriz.Beneficiarios_convenio AS beneficiariosConvenio, 
            matriz.Aprovacion AS aprovacionMatriz, 
            matriz.Empresa AS empresaMatriz, 
            matriz.Naturaleza_empresa AS naturalezaEmpresa, 
            matriz.Tipo_empresa AS tipoEmpresaMatriz, 
            matriz.Representante_empresa AS representanteMatriz, 
            matriz.Direccion_empresa AS direccionMatriz, 
            matriz.Correo_empresa AS correoMatriz, 
            matriz.Telefono_empresa AS telefonoMatriz, 
            matriz.Sector_Productivo AS sectorProductivo, 
            matriz.Fecha_suscripcion AS fechaSuscripcionMatriz, 
            matriz.Fecha_terminacion AS fechaTerminacionMatriz
        FROM matriz 
        WHERE matriz.id = ?";
        $result = $this->db->query($query,[$idMatriz]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }
}
