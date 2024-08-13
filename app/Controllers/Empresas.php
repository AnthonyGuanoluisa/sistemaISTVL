<?php

namespace App\Controllers;

use App\Models\Empresa;
use App\Models\Carrera;
use App\Models\Asignacion;
use App\Models\Usuario;
use App\Models\Cargo;
use App\Models\Matriz;
use App\Models\Proyecto;
use DateTime;

class Empresas extends BaseController
{
    public function index()
    {
        $request = \Config\Services::request();
        $name = $request->getGet('name');

        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarrerasParaCursos();
        $asignacion = new Asignacion();
        $data["asignacion"] = $asignacion->buscarAsignacion();
        $data['urlCode'] = 'some_value';
        $data['name'] = $name; 
        return view('Empresas/index', $data);
    }

    public function indexCoordinador()
    {
        $request = \Config\Services::request();
        $nombreAsignacion = $request->getGet('name');


        $asi = new Asignacion();
        $Asignacion = $asi->buscarIdAsignacion($nombreAsignacion);
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        $data['NombreAsig'] = $nombreAsignacion;
        $data['idAsig'] = $Asignacion;

        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarrerasParaCursos();
        $asignacion = new Asignacion();
        $data["asignacion"] = $asignacion->buscarAsignacion();
        $data['urlCode'] = 'some_value';
        $data['name'] = $nombreAsignacion; 
        return view('Empresas/indexCoordinador', $data);
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
        $data['urlCode'] = 'some_value';
        $data['cargoUsuario'] = $cargoUsuario;
        $data['nombreCargoUsuario'] = $datosCargo['Nombre_Cargo'];
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Empresas/indexVinculacion', $data);
    }

    public function indexPracticas()
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
        $data['urlCode'] = 'some_value';
        $data['cargoUsuario'] = $cargoUsuario;
        $data['nombreCargoUsuario'] = $datosCargo['Nombre_Cargo'];
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Empresas/indexPracticas', $data);
    }
    public function listarRegistros()
    {
        $request = \Config\Services::request();
        $nombreAsignacion = $request->getPost('name');

        $asi = new Asignacion();
        $Asignacion = $asi->buscarIdAsignacion($nombreAsignacion);
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

            $empresa = new Empresa();
            $data["lista"] = $empresa->buscarRegistros();
            $data["current_date"] = $formatted_date;
            return view('Empresas/lista', $data);
        
    }

    public function listarRegistrosCoordinador()
    {
        $request = \Config\Services::request();
        $nombreAsignacion = $request->getPost('name');

        $asi = new Asignacion();
        $Asignacion = $asi->buscarIdAsignacion($nombreAsignacion);
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        if($nombreAsignacion == "VINCULACION" or "VINCULACIÓN"){

            $empresa = new Empresa();
            $data["lista"] = $empresa->buscarEmpresasPorAsignacion($Asignacion);
            $data["current_date"] = $formatted_date;
            return view('Empresas/lista', $data);
        }else if($nombreAsignacion == "PRACTICAS" or "PRÁCTICAS" ){

            $empresa = new Empresa();
            $data["lista"] = $empresa->buscarEmpresasPorAsignacion($Asignacion);
            $data["current_date"] = $formatted_date;
            return view('Empresas/lista', $data);
        }
        
    }

    public function listarRegistrosAsignacion()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario();
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carreraUsuario = $datosUsuario['carrera'];
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $empresa = new Empresa();
        $data["listaAsignacion"] = $empresa->buscarEmpresasPorCarrerayAsignacion($cargoUsuario, $carreraUsuario);
        $data["current_date"] = $formatted_date;
        return view('Empresas/listaAsignacion', $data);
    }
    
    public function gestionRegistro()
    {
        $request = \Config\Services::request();
        $idEmpresa =  $this->request->getPost("idEmpresa");
        $nombreEmpresa =  $this->request->getPost("nombreEmpresa");
        $nombreEncargado =  $this->request->getPost("nombreEncargado");
        $rucEmpresa =  $this->request->getPost("rucEmpresa");
        $directEmpresa =  $this->request->getPost("directEmpresa");
        $correoEmpresa =  $this->request->getPost("correoEmpresa");
        $teleEmpresa =  $this->request->getPost("teleEmpresa");
        $convEmpresa =  $this->request->getPost("convEmpresa");
        $caduEmpresa =  $this->request->getPost("caduEmpresa");
        $cuposEmpresa =  $this->request->getPost("cuposEmpresa");
        $asignacionEmpresa =  $this->request->getPost("asignacionEmpresa");
        $carreraEmpresa =  $this->request->getPost("carreraEmpresa");

        $Ncarrera = new Carrera();
        $nombreCarrera = $Ncarrera->buscarNombreCarreraPorID($carreraEmpresa);
        $codigoEmpresa =  $this->request->getPost("codigoEmpresa");
        $data = [
            "Nombre_empresa" => $nombreEmpresa,
            "Encargado" => $nombreEncargado,
            "Ruc_Empresa" => $rucEmpresa,
            "Direccion" => $directEmpresa,
            "Correo_Empresa" => $correoEmpresa,
            "Telefono" => $teleEmpresa,
            "Fecha_Convenio" => $convEmpresa,
            "Fecha_Caducidad_Convenio" => $caduEmpresa,
            "Cupos" => $cuposEmpresa,
            "Asignacion" => $asignacionEmpresa,
            "Carrera" => $carreraEmpresa,
            "Codigo" => $codigoEmpresa
        ];

        $data2 = [
            "Empresa" => $nombreEmpresa,
            "Representante_empresa" => $nombreEncargado,
            "Direccion_empresa" => $directEmpresa,
            "Correo_empresa" => $correoEmpresa,
            "Telefono_empresa" => $teleEmpresa,
            "Fecha_suscripcion" => $convEmpresa,
            "Fecha_terminacion" => $caduEmpresa,
            "Carrera" => $nombreCarrera,
            "Aprovacion" => $codigoEmpresa
        ];

        $empresa = new Empresa();
        $matriz = new Matriz();

        if ($idEmpresa > 0) {
            $resultado = 'e|' . $empresa->editarRegistro($idEmpresa, $data);
        } else {
            $resultado = 'i|' . $empresa->insertarRegistro($data);
            $resultado = 'i|' . $matriz->insertarRegistro($data2);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idEmpresa = $this->request->getPost("idEmpresa");
        $empresa = new Empresa();
        $resultado = $empresa->buscarRegistroPorID($idEmpresa);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idEmpresa = $this->request->getPost("idEmpresa");
        $empresa = new Empresa();
        $resultado = $empresa->eliminarRegistro($idEmpresa);
        echo json_encode($resultado);
    }

    public function obtenerProyectosPorEmpresa($nombreEmpresa)
    {
        $proyecto = new Proyecto();
        $proyectos = $proyecto->buscarProyectosPorNombreEmpresa($nombreEmpresa);

        echo json_encode($proyectos);
    }


    public function buscarEmpresaCarreraPracticas()
    {   
        $nombreAsignacion = 'PRACTICAS';
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);

        $idCarrera = $this->request->getPost("carreraEmpresa"); 
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        $empresa = new Empresa();
        $resultado = $empresa->buscarEmpresaPorCarreraPracticas($idCarrera,$formatted_date,$idAsignacion);
        echo json_encode($resultado); 
    }

    public function buscarEmpresaCarreraVinculacion()
    {   
        $nombreAsignacion = 'VINCULACION';
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);

        $idCarrera = $this->request->getPost("carreraEmpresa"); 
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        $empresa = new Empresa();
        $resultado = $empresa->buscarEmpresaCarreraVinculacion($idCarrera,$formatted_date,$idAsignacion);
        echo json_encode($resultado); 
    }
}
