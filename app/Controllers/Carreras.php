<?php

namespace App\Controllers;

use App\Models\Carrera;

class Carreras extends BaseController
{
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Carreras/index',$data);
    }

    public function listarRegistros()
    {
        $carrera = new Carrera();
        $data["lista"] = $carrera->buscarCarreras();
        return view('Carreras/lista', $data);
    }

    public function gestionRegistro()
    {
        $idCarrera =  $this->request->getPost("idCarrera");
        $NombreCarrera =  $this->request->getPost("NombreCarrera");
        $codigoCarrera =  $this->request->getPost("codigoCarrera");
        $data = [
            "Nombre_Carrera" => $NombreCarrera,
            "Codigo" => $codigoCarrera,
        ];
        $carrera = new Carrera();
        if ($idCarrera > 0) {
            $resultado = 'e|' . $carrera->editarRegistro($idCarrera, $data);
        } else {
            $resultado = 'i|' . $carrera->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idCarrera = $this->request->getPost("idCarrera");
        $carrera = new Carrera();
        $resultado = $carrera->buscarRegistroPorID($idCarrera);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idCarrera = $this->request->getPost("idCarrera");
        $carrera = new Carrera();
        $resultado = $carrera->eliminarRegistro($idCarrera);
        echo json_encode($resultado);
    }
}
