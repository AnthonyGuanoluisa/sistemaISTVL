<?php

namespace App\Controllers;

use App\Models\Asignacion;
use App\Models\Practicas;
use App\Models\Usuario;
use App\Models\Cargo;
use App\Models\Estudiante;
use App\Models\Empresa;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\Tutor;
use App\Models\Carrera;
use DateTime;

class ListadosPracticas extends BaseController
{
    public function index()
    {
        //index del administrador
        $cedula = new Estudiante();
        $data["cedulaEstudiante"] = $cedula->buscarEstudianteDSW();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $cursos = new Curso();
        $data["cursos"] = $cursos->buscarCursos();
        $cursos = new Tutor();
        $data["tutores"] = $cursos->buscarTutorDSW();
        $data['urlCode'] = 'some_value';
            return view('ListadosPracticas/index', $data);
    }

    public function indexPracticas()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $carreraUsuario = $session->get('carreraUsuario');
        
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carrera = $datosUsuario['carrera'];
        $idCarrera = $session->get('idCarrera');


        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $data["carreras"] = $carreras->buscarCarreras();
        $cursos = new Curso();
        $data["cursos"] = $cursos->buscarCursosPorCarrera($carrera);

        $cursos = new Tutor();
        $data["tutores"] = $cursos->buscarTutorPorCarrera($carrera);

        $cedula = new Estudiante();
        $data["cedulaEstudiante"] = $cedula->buscarEstudiantePorCarrera($carrera);

        $empresa = new Empresa();
        $data["empresa"] = $empresa->buscarEmpresasPorCarrerayAsignacionParaListado($cargoUsuario, $carrera, $formatted_date);

        

        if ($carreraUsuario == 'DESARROLLO DE SOFTWARE'){
            $data['urlCode'] = 'some_value';
            return view('ListadoPracticasDSW/indexPracticas', $data);
            
        } else {
            $data['urlCode'] = 'some_value';
            return view('ListadosPracticas/indexPracticas', $data);
        }
    }

    public function listarRegistros()
    {

        $practicas = new Practicas();
        $data["lista"] = $practicas->buscarRegistros();
        //$data["lista"] = $practicas->buscarRegistros();
        return view('ListadosPracticas/lista', $data);
    }

    public function listarRegistro()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $carreraUsuario = $session->get('carreraUsuario');
        $idCarrera = $session->get('idCarrera');
        
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $cargoUsuario = $datosUsuario['Cargo'];
        $carrera = $datosUsuario['carrera'];

        $practicas = new Practicas();
        $data["lista"] = $practicas->buscarRegistrosPorCarreras($idCarrera);
        //$data["lista"] = $practicas->buscarRegistros();
        return view('ListadosPracticas/lista', $data);
    }

    public function gestionRegistro()
    {
        $idPracticas =  $this->request->getPost("idPracticas");
        $nombreEstudiante =  $this->request->getPost("nombreEstudiante");
        $empresaPracticas =  $this->request->getPost("empresaPracticas");
        $horasPracticas =  $this->request->getPost("horasPracticas");

        $carreraPracticas =  $this->request->getPost("carreraPracticas");


        $fechaInicio =  $this->request->getPost("fechaInicio");
        $fechaFin =  $this->request->getPost("fechaFin");
        $cursoPracticas =  $this->request->getPost("cursoPracticas");
        $horasCulminacion =  $this->request->getPost("horasCulminacion");
        $aprobadoPracticas =  $this->request->getPost("aprobadoPracticas");
        $tutorPracticas =  $this->request->getPost("tutorPracticas");

        $session = \Config\Services::session();
        $cargoUsuario = $session->get('cargoUsuario');
        $nombreAsignacion = 'PRACTICAS' or $cargoUsuario;
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
        $data = [
            "Cedula" => $nombreEstudiante,
            "Empresa" => $empresaPracticas,
            "Horas" => $horasPracticas,
            "Fecha_Inicio" => $fechaInicio,
            "Fecha_Fin" => $fechaFin,
            "Curso" => $cursoPracticas,
            "Carrera" => $carreraPracticas,
            "Total_Horas" => $horasCulminacion,
            "Aprobado" => $aprobadoPracticas,
            "Tutor_Academico" => $tutorPracticas,
        ];
        $practicas = new Practicas();
        $empresa = new Empresa();
        $existeEstudiantePracticas = $practicas->existeUsuarioPrac($nombreEstudiante);
        $cuposDisponibles = $empresa->verificarCupos($empresaPracticas, $idAsignacion, $carreraPracticas);
        
        if ($idPracticas > 0) {
            $resultado = 'e|' . $practicas->editarRegistro($idPracticas, $data);
        } else { 
            if (!$existeEstudiantePracticas) {
                if ($cuposDisponibles <= 0) {
                    $resultado = 'd|';
                } else {
                    $empresa->restarCupo($empresaPracticas, $idAsignacion, $carreraPracticas);
                    $resultado = 'i|' . $practicas->insertarRegistro($data);
                }
            } else {
                $resultado = 'f|';
            }
        }
        
        echo json_encode($resultado);
    }

    /*public function gestionRegistro()
    {
        $idPracticas =  $this->request->getPost("idPracticas");
        $nombreEstudiante =  $this->request->getPost("nombreEstudiante");
        $empresaPracticas =  $this->request->getPost("empresaPracticas");
        $horasPracticas =  $this->request->getPost("horasPracticas");
        $carreraPracticas =  $this->request->getPost("carreraPracticas");
        $fechaInicio =  $this->request->getPost("fechaInicio");
        $fechaFin =  $this->request->getPost("fechaFin");
        $cicloPracticas =  $this->request->getPost("cicloPracticas");
        $cursoPracticas =  $this->request->getPost("cursoPracticas");
        $horasCulminacion =  $this->request->getPost("horasCulminacion");
        $aprobadoPracticas =  $this->request->getPost("aprobadoPracticas");
        $tutorPracticas =  $this->request->getPost("tutorPracticas");
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $asignacion = $datosUsuario['Cargo'];
        $data = [
            "Cedula" => $nombreEstudiante,
            "Empresa" => $empresaPracticas,
            "Horas" => $horasPracticas,
            "Fecha_Inicio" => $fechaInicio,
            "Fecha_Fin" => $fechaFin,
            "Ciclo_Academico" => $cicloPracticas,
            "Curso" => $cursoPracticas,
            "Carrera" => $carreraPracticas,
            "Total_Horas" => $horasCulminacion,
            "Aprobado" => $aprobadoPracticas,
            "Tutor_Academico" => $tutorPracticas,
        ];
        $practicas = new  Practicas();
        $empresa = new Empresa();
        $cuposDisponibles = $empresa->verificarCupos($empresaPracticas,$asignacion);
            if ($idPracticas > 0) {
                $resultado = 'e|' . $practicas->editarRegistro($idPracticas, $data);
            } else {
                if($cuposDisponibles <= 0){
                    $resultado = 'd|';
                }else{
                    $empresa->restarCupo($empresaPracticas,$asignacion);
                    $resultado = 'i|' . $practicas->insertarRegistro($data);
                }
            }
        echo json_encode($resultado);
    }*/

    public function buscarRegistroPorID()
    {
        $idPracticas = $this->request->getPost("idPracticas");
        $practicas = new Practicas();
        $resultado = $practicas->buscarRegistroPorID($idPracticas);
        echo json_encode($resultado);
    }

    /*public function buscarRegistroPorID()
    {
        $idPracticas = $this->request->getPost("idPracticas");
        $practicas = new Practicas();
        $resultado = $practicas->buscarRegistroPorID($idPracticas);
        echo json_encode($resultado);
    }*/

    public function eliminarRegistro()
    {
        $idPracticas = $this->request->getPost("idPracticas");
        $practicas = new Practicas();
        $resultado = $practicas->eliminarRegistro($idPracticas);
        echo json_encode($resultado);
    }

    /*public function eliminarRegistro()
    {
        $idPracticas = $this->request->getPost("idPracticas");
        $practicas = new Practicas();
        $resultado = $practicas->eliminarRegistro($idPracticas);
        echo json_encode($resultado);
    }*/
}
