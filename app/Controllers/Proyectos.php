<?php

namespace App\Controllers;

use App\Models\Proyecto;
use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Cargo;

class Proyectos extends BaseController
{
    public function index()
    {
        $carrera = new Carrera();
        $data["carrera"] = $carrera->buscarCarreras();
        $empresa = new Empresa();
        $Asignacion = "Vinculacion";
        $data["empresa"] = $empresa->buscarEmpresasPorAsignacionNombre($Asignacion);
        $data['urlCode'] = 'some_value';
        return view('Proyectos/index', $data);
    }

    public function indexVinculacion()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carreraUsuario = $datosUsuario['carrera'];
        $cargo = new Cargo();
        $datosCargo = $cargo->find($cargoUsuario);
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $empresa = new Empresa();
        $data["empresa"] = $empresa->buscarEmpresasPorCarrerayAsignacion($cargoUsuario, $carreraUsuario);
        $data['urlCode'] = 'some_value';
        $data['cargoUsuario'] = $cargoUsuario;
        $data['nombreCargoUsuario'] = $datosCargo['Nombre_Cargo'];
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Proyectos/indexVinculacion', $data);
    }

    public function listarRegistros()
    {
        $session = \Config\Services::session();
        $proyecto = new Proyecto();
        $data["lista"] = $proyecto->buscarRegistros();
        return view('Proyectos/lista', $data);
    }

    public function listarRegistro()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario();
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carreraUsuario = $datosUsuario['carrera'];
        $proyecto = new Proyecto();
        $data["lista"] = $proyecto->buscarProyectosPorCarrera($carreraUsuario);
        return view('Proyectos/lista', $data);
    }

    public function gestionRegistro()
    {
        $idProyecto =  $this->request->getPost("idProyecto");
        $empresaProyecto =  $this->request->getPost("empresaProyecto");
        $nombreProyecto =  $this->request->getPost("nombreProyecto");
        $carreraProyecto =  $this->request->getPost("carreraProyecto");
        $codigoProyecto =  $this->request->getPost("codigoProyecto");
        $data = [
            "Empresa" => $empresaProyecto,
            "Nombre_Proyecto" => $nombreProyecto,
            "Carrera" => $carreraProyecto,
            "Codigo" => $codigoProyecto,
        ];
        $proyecto = new Proyecto();
        if ($idProyecto > 0) {
            $resultado = 'e|' . $proyecto->editarRegistro($idProyecto, $data);
        } else {
            $resultado = 'i|' . $proyecto->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idProyecto = $this->request->getPost("idProyecto");
        $proyecto = new Proyecto();
        $resultado = $proyecto->buscarRegistroPorID($idProyecto);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idProyecto = $this->request->getPost("idProyecto");
        $proyecto = new Proyecto();
        $resultado = $proyecto->eliminarRegistro($idProyecto);
        echo json_encode($resultado);
    }

    public function buscarRegistroID()
    {
        $idEmpresa = $this->request->getPost("empresaProyecto"); 
        $proyecto = new Proyecto();
        $resultado = $proyecto->buscarRegistroID($idEmpresa);
        echo json_encode($resultado); 
    }

}
