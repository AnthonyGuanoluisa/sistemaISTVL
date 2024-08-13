<?php

namespace App\Controllers;

use App\Models\Nivel;

class Niveles extends BaseController
{
    public function listarRegistros()
    {
        $nivel = new Nivel();
        $data["listaNivel"] = $nivel->buscarNivel();
        return view('Cursos/listaNivel', $data);
    }

    public function gestionRegistro()
    {
        $idNivel =  $this->request->getPost("idNivel");
        $nombreNivel =  $this->request->getPost("nombreNivel");
        $data = [
            "Nivel" => $nombreNivel,
        ];
        $nivel = new Nivel();
        if ($idNivel > 0) {
            $resultado = 'e|' . $nivel->editarNivel($idNivel, $data);
        } else {
            $resultado = 'i|' . $nivel->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idNivel = $this->request->getPost("idNivel");
        $nivel = new Nivel();
        $resultado = $nivel->buscarRegistroPorID($idNivel);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idNivel = $this->request->getPost("idNivel");
        $nivel = new Nivel();
        $resultado = $nivel->eliminarRegistro($idNivel);
        echo json_encode($resultado);
    }
}
