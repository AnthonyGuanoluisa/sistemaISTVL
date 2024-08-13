<?php

namespace App\Controllers;

use App\Models\Periodo;

class Periodos extends BaseController
{
    public function listarRegistros()
    {
        $periodo = new Periodo();
        $data["listaPeriodos"] = $periodo->buscarPeriodo();
        return view('Cursos/listaPeriodos', $data);
    }

    public function gestionRegistro()
    {
        $idPeriodos =  $this->request->getPost("idPeriodos");
        $tipoCiclo =  $this->request->getPost("tipoCiclo");
        $data = [
            "Ciclo_Academico" => $tipoCiclo,
        ];
        $periodo = new Periodo();
        if ($idPeriodos > 0) {
            $resultado = 'e|' . $periodo->editarPeriodo($idPeriodos, $data);
        } else {
            $resultado = 'i|' . $periodo->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idPeriodos = $this->request->getPost("idPeriodos");
        $periodo = new Periodo();
        $resultado = $periodo->buscarRegistroPorID($idPeriodos);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idPeriodos = $this->request->getPost("idPeriodos");
        $periodo = new Periodo();
        $resultado = $periodo->eliminarRegistro($idPeriodos);
        echo json_encode($resultado);
    }
}
