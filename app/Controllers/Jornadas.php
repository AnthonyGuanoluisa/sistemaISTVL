<?php

namespace App\Controllers;

use App\Models\Jornada;

class Jornadas extends BaseController
{
    public function listarRegistros()
    {
        $jornada = new Jornada();
        $data["listaJornada"] = $jornada->buscarJornada();
        return view('Cursos/listaJornada', $data);
    }

    public function gestionRegistro()
    {
        $idJornada =  $this->request->getPost("idJornada");
        $tipoJornada =  $this->request->getPost("tipoJornada");
        $data = [
            "Tipo_Jornada" => $tipoJornada,
        ];
        $jornada = new Jornada();
        if ($idJornada > 0) {
            $resultado = 'e|' . $jornada->editarJornada($idJornada, $data);
        } else {
            $resultado = 'i|' . $jornada->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idJornada = $this->request->getPost("idJornada");
        $jornada = new Jornada();
        $resultado = $jornada->buscarRegistroPorID($idJornada);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idJornada = $this->request->getPost("idJornada");
        $jornada = new Jornada();
        $resultado = $jornada->eliminarRegistro($idJornada);
        echo json_encode($resultado);
    }
}
