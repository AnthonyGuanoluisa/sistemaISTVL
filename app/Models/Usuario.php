<?php

namespace App\Models;
use CodeIgniter\Model;
use Exception;

helper('system');

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Usuario','Cedula', 'Contraseña', 'Confir_Contraseña', 'Cargo', 'carrera'];
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
        $query = " SELECT
                usuarios.id, 
                usuarios.Usuario, 
                usuarios.Cedula, 
                usuarios.Contraseña as Contraseña, 
                usuarios.Confir_Contraseña, 
                cargos.Nombre_Cargo AS Cargo, 
                carreras.Nombre_Carrera AS carrera
            FROM usuarios 
            LEFT JOIN carreras ON usuarios.Carrera = carreras.id 
            LEFT JOIN cargos ON usuarios.Cargo = cargos.id 
            ORDER BY CASE WHEN carreras.Nombre_Carrera = 'coordinacion' THEN 0 ELSE 1 END, carreras.Nombre_Carrera ASC ,Usuario ASC";
        $result = $this->db->query($query);
        return $result->getResult() ? $result->getResult() : false;
    }

    public function buscarRegistroPorID($idUsuario)
    {
        $query = "SELECT
            usuarios.id AS idUsuario, 
            usuarios.Usuario AS nombreUsuario, 
            usuarios.Cedula AS cedulaUsuario, 
            usuarios.Contraseña AS claveUsuario,
            usuarios.Confir_Contraseña as confirClave, 
            usuarios.Cargo AS cargoUsuario, 
            usuarios.carrera AS carreraUsuario
        FROM usuarios 
        WHERE usuarios.id = ?";
        $result = $this->db->query($query,[$idUsuario]);
        return $result->getResult() ? $result->getResult()[0] : false;
    }

    public function buscarUsuario($idUsuario)
    {
        $query = "SELECT
            usuarios.id AS idUsuario, 
            usuarios.Usuario AS nombreUsuario, 
            usuarios.Cedula AS cedulaUsuario, 
            usuarios.Contraseña AS claveUsuario,  
            usuarios.Confir_Contraseña as confirClave, 
            cargos.Nombre_Cargo AS cargoUsuario, 
            IFNULL(carreras.id, 0) AS idCarrera,
            IFNULL(carreras.Nombre_Carrera, '') AS carreraUsuario
        FROM usuarios 
        LEFT JOIN carreras ON usuarios.Carrera = carreras.id 
        INNER JOIN cargos ON usuarios.Cargo = cargos.id  
        WHERE usuarios.id = :idUsuario:";
        $result = $this->db->query($query, ['idUsuario' => $idUsuario]);
        return $result->getRow();
    }
    

    public function buscarUsuarioCarreras($idUsuario)
    {
        $query = "SELECT
            usuarios.id AS idUsuario, 
            usuarios.Usuario AS nombreUsuario, 
            usuarios.Cedula AS cedulaUsuario, 
            usuarios.Contraseña AS claveUsuario,  
            usuarios.Confir_Contraseña as confirClave, 
            cargos.Nombre_Cargo AS cargoUsuario, 
            carreras.id AS idCarrera,
            carreras.Nombre_Carrera AS carreraUsuario
        FROM usuarios 
        INNER JOIN carreras ON usuarios.Carrera = carreras.id 
        INNER JOIN cargos ON usuarios.Cargo = cargos.id  
        WHERE usuarios.id = :idUsuario:";
        $result = $this->db->query($query, ['idUsuario' => $idUsuario]);
        return $result->getRow();
    }

    public function existeUsuario($cedulaUsuario) {
        $query = "SELECT Cedula FROM usuarios WHERE Cedula = ?";
        $result = $this->db->query($query, [$cedulaUsuario]);

        return $result->getRow() !== null;
    }

}
