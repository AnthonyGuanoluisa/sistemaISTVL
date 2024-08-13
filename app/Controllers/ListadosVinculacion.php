<?php

namespace App\Controllers;

use App\Models\Vinculacion;
use App\Models\Usuario;
use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Empresa;
use App\Models\Periodo;
use App\Models\Asignacion;
use App\Models\Proyecto;
use App\Models\Carrera;
use DateTime;


class ListadosVinculacion extends BaseController
{
    public function index()
    {
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $periodo = new Periodo();
        $data["ciclo"] = $periodo->buscarPeriodo();
        $data['urlCode'] = 'some_value';
        return view('ListadosVinculacion/index', $data);
    }
    public function indexVinculacion()
    {

        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $carreraUsuario = $session->get('carreraUsuario');

        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carrera = $datosUsuario['carrera'];

        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');

        $carreras = new Carrera();

        $data["carreras"] = $carreras->buscarRegistroPorID($carrera);
        
        $ciclo = new Periodo();
        $data["ciclo"] = $ciclo->buscarPeriodo();

        $cedula = new Estudiante();
        $data["cedulaEstudiante"] = $cedula->buscarEstudiantePorCarrera($carrera);

        $cargo = new Cargo();
        $datosCargo = $cargo->find($cargoUsuario);
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $empresa = new Empresa();
        $data["empresa"] = $empresa->buscarEmpresasPorCarrerayAsignacionParaListado($cargoUsuario, $carrera, $formatted_date);
        
        $data['urlCode'] = 'some_value';
        return view('ListadosVinculacion/indexVinculacion', $data);
    }

    public function listarRegistros()
    {
        $vinculacion = new Vinculacion();
        $data["lista"] = $vinculacion->buscarRegistros();
        return view('ListadosVinculacion/lista', $data);
    }

    public function listarRegistro()
    {

        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $carreraUsuario = $session->get('carreraUsuario');

        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carrera = $datosUsuario['carrera'];

        $vinculacion = new Vinculacion();
        $data["lista"] = $vinculacion->buscarRegistrosPorCarreras($carrera);
        //$data["lista"] = $vinculacion->buscarRegistros();
        return view('ListadosVinculacion/listaNormal', $data);
    }

    public function gestionRegistro()
    {
        $idVinculacion =  $this->request->getPost("idVinculacion");
        $nombreEstudiante =  $this->request->getPost("nombreEstudiante");
        $empresaVinc =  $this->request->getPost("empresaVinc");
        $horasVin =  $this->request->getPost("horasVin");
        $carreraVin =  $this->request->getPost("carreraEmpresa");
        $nCarrera = new Carrera();
        $nombreCarrera = $nCarrera->buscarNombreCarreraPorID($carreraVin);
        $fechaInicio =  $this->request->getPost("fechaInicio");
        $fechaFin =  $this->request->getPost("fechaFin");
        $cicloVin =  $this->request->getPost("cicloVin");
        $proyectosVin =  $this->request->getPost("proyectosVin");
        $horasCulminacion =  $this->request->getPost("horasCulminacion");
        $aprobadoVin =  $this->request->getPost("aprobadoVin");
        $nEmpresa = new Empresa();
        $nombreEmpresa = $nEmpresa->nombreEmpresaID($empresaVinc);

        $session = \Config\Services::session();
        $cargoUsuario = $session->get('cargoUsuario');
        $nombreAsignacion = 'VINCULACIÓN' or $cargoUsuario;
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
        $data = [
            "Cedula" => $nombreEstudiante,
            "Empresa" => $empresaVinc,
            "Horas" => $horasVin,
            "Fecha_Inicio" => $fechaInicio,
            "Fecha_Fin" => $fechaFin,
            "Periodo" => $cicloVin,
            "Proyecto" => $proyectosVin,
            "Carrera" => $carreraVin,
            "Total_Horas" => $horasCulminacion,
            "Aprobado" => $aprobadoVin,
        ];
        $vinculacion = new  Vinculacion();
        $empresa = new Empresa();

        $existeEstudianteVinculacion = $vinculacion->existeUsuarioVin($nombreEstudiante);

        $cuposDisponibles = $empresa->verificarCupos($nombreEmpresa, $idAsignacion, $carreraVin);

        if ($idVinculacion > 0) {
            $resultado = 'e|' . $vinculacion->editarRegistro($idVinculacion, $data);
        } else {
            if (!$existeEstudianteVinculacion) {
                if ($cuposDisponibles <= 0) {
                    $resultado = 'd|';
                } else {
                    $empresa->restarCupo($nombreEmpresa, $idAsignacion, $carreraVin);
                    $resultado = 'i|' . $vinculacion->insertarRegistro($data);
                }
            } else {
                $resultado = 'f|';
            }
        }
        echo json_encode($resultado);
    }

    /*public function gestionRegistro()
    {
        $idVinculacion =  $this->request->getPost("idVinculacion");
        $nombreEstudiante =  $this->request->getPost("nombreEstudiante");
        $empresaVinc =  $this->request->getPost("empresaVinc");
        $horasVin =  $this->request->getPost("horasVin");
        $carreraVin =  $this->request->getPost("carreraVin");
        $fechaInicio =  $this->request->getPost("fechaInicio");
        $fechaFin =  $this->request->getPost("fechaFin");
        $cicloVin =  $this->request->getPost("cicloVin");
        $proyectosVin =  $this->request->getPost("proyectosVin");

        $horasCulminacion =  $this->request->getPost("horasCulminacion");
        $aprobadoVin =  $this->request->getPost("aprobadoVin");

        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $asignacion = $datosUsuario['Cargo'];

        $data = [
            "Cedula" => $nombreEstudiante,
            "Empresa" => $empresaVinc,
            "Horas" => $horasVin,
            "Fecha_Inicio" => $fechaInicio,
            "Fecha_Fin" => $fechaFin,
            "Ciclo_Academico" => $cicloVin,
            "Proyecto" => $proyectosVin,
            "Carrera" => $carreraVin,

            "Total_Horas" => $horasCulminacion,
            "Aprobado" => $aprobadoVin,
        ];

        $vinculacion = new  Vinculacion();
        $empresa = new Empresa();
        $cuposDisponibles = $empresa->verificarCupos($empresaVinc,$asignacion,$carreraVin);

        if ( $idVinculacion > 0) {
            $resultado = 'e|' . $vinculacion->editarRegistro($idVinculacion, $data);
        }else{
            if ($cuposDisponibles <= 0) {
                $resultado = 'd|';
            } else {
                $empresa->restarCupo($empresaVinc,$asignacion,$carreraVin);
                $resultado = 'i|' . $vinculacion->insertarRegistro($data);
            }
        }
            echo json_encode($resultado);
    }*/
 
    public function buscarRegistroPorID()
    {
        $idVinculacion = $this->request->getPost("idVinculacion");
        $vinculacion = new Vinculacion();
        $resultado = $vinculacion->buscarRegistroPorID($idVinculacion);
        echo json_encode($resultado);
    }

    /*public function buscarRegistroPorID()
    {
        $idVinculacion = $this->request->getPost("idVinculacion");
        $vinculacion = new Vinculacion();
        $resultado = $vinculacion->buscarRegistroPorID($idVinculacion);
        echo json_encode($resultado);
    }*/

    public function eliminarRegistro()
    {
        $idVinculacion = $this->request->getPost("idVinculacion");
        $vinculacion = new Vinculacion();
        $resultado = $vinculacion->eliminarRegistro($idVinculacion);
        echo json_encode($resultado);
    }

    /*public function eliminarRegistro()
    {
        $idVinculacion = $this->request->getPost("idVinculacion");
        $vinculacion = new Vinculacion();
        $resultado = $vinculacion->eliminarRegistro($idVinculacion);
        echo json_encode($resultado);
    }*/
    
}
