<?php

namespace App\Controllers;

use App\Models\Cargo;

class Cargos extends BaseController
{
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Cargos/index',$data);
    }

    public function listarRegistros()
    {
        $cargo = new Cargo();
        $data["lista"] = $cargo->buscarCargos();
        return view('Cargos/lista', $data);
    }

    public function gestionRegistro()
    {
        $idCargo =  $this->request->getPost("idCargo");
        $NombreCargo =  $this->request->getPost("NombreCargo");
        $data = [
            "Nombre_Cargo" => $NombreCargo,
        ];
        $cargo = new Cargo();
        if ($idCargo > 0) {
            $resultado = 'e|' . $cargo->editarRegistro($idCargo, $data);
        } else {
            $resultado = 'i|' . $cargo->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idCargo = $this->request->getPost("idCargo");
        $cargo = new Cargo();
        $resultado = $cargo->buscarRegistroPorID($idCargo);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idCargo = $this->request->getPost("idCargo");
        $cargo = new Cargo();
        $resultado = $cargo->eliminarRegistro($idCargo);
        echo json_encode($resultado);
    }
}
