<?php

namespace App\Controllers;

use App\Models\Asignacion;

class Asignaciones extends BaseController
{
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Asignacion/index',$data);
    }

    public function listarRegistros()
    {
        $asignacion = new Asignacion();
        $data["lista"] = $asignacion->buscarAsignacion();
        return view('Asignacion/lista', $data);
    }

    public function gestionRegistro()
    {
        $idAsignacion =  $this->request->getPost("idAsignacion");
        $NombreAsignacion =  $this->request->getPost("NombreAsignacion");
        $data = [
            "Nombre_Asignación" => $NombreAsignacion,
        ];
        $asignacion = new Asignacion();
        if ($idAsignacion > 0) {
            $resultado = 'e|' . $asignacion->editarRegistro($idAsignacion, $data);
        } else {
            $resultado = 'i|' . $asignacion->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idAsignacion = $this->request->getPost("idAsignacion");
        $asignacion = new Asignacion();
        $resultado = $asignacion->buscarRegistroPorID($idAsignacion);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idAsignacion = $this->request->getPost("idAsignacion");
        $asignacion = new Asignacion();
        $resultado = $asignacion->eliminarRegistro($idAsignacion);
        echo json_encode($resultado);
    }
}
