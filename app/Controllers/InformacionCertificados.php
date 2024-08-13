<?php

namespace App\Controllers;

use App\Models\InformacionCertificado;

class InformacionCertificados extends BaseController
{
    public function listarRegistros()
    {
        $informacionCertificado = new InformacionCertificado();
        $data["listaInformacion"] = $informacionCertificado->buscarRegistros();
        return view('Certificados/listaInformacion', $data);
    }

    public function gestionRegistroInfo()
    {
        $idInformacion =  $this->request->getPost("idInformacion");
        $rector =  $this->request->getPost("rector");
        $cedulaRector =  $this->request->getPost("cedulaRector");
        $encargado =  $this->request->getPost("encargado");
        $cedulaEncargado =  $this->request->getPost("cedulaEncargado");
        $fechaCertificacion =  $this->request->getPost("fechaCertificacion");
        $data = [
            "Rector_Institucional" => $rector,
            "Cedula_Rector" => $cedulaRector,
            "Encargado_Certificacion" => $encargado ,
            "Cedula_Encargado" => $cedulaEncargado,
            "Fecha" => $fechaCertificacion,
        ];

        $informacionCertificado = new InformacionCertificado();
        $resultado = $informacionCertificado->editarRegistroInfo($idInformacion, $data);
        echo json_encode($resultado);
        
    }

    public function buscarRegistroPorID()
    {
        $idInformacion = $this->request->getPost("idInformacion");
        $informacionCertificado = new InformacionCertificado();
        $resultado = $informacionCertificado->buscarRegistroPorID($idInformacion);
        echo json_encode($resultado);
    }
}
