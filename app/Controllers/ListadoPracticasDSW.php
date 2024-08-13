<?php

namespace App\Controllers;

use App\Models\PracticasDSW;
use App\Models\Usuario;
use App\Models\Cargo;
use App\Models\Estudiante;
use App\Models\Empresa;
use App\Models\Periodo;
use App\Models\Curso;
use App\Models\Tutor;
use App\Models\Carrera;
use App\Models\Asignacion;
use DateTime;



class ListadoPracticasDSW extends BaseController
{
    
    public function index()
    {
        $cedula = new Estudiante();
        $data["cedulaEstudiante"] = $cedula->buscarEstudianteDSW();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $empresa = new Empresa();
        $current_date = new DateTime();
        $formatted_date = $current_date->format('Y-m-d');
        $nombreAsignacion = 'PRACTICAS' or 'PRÁCTICAS';
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
        $data["empresa"] = $empresa->buscarEmpresaDSW($formatted_date,$idAsignacion);

        $nombreCarrera = 'DESARROLLO DE SOFTWARE';
        $idCarrera = $carreras->idCarrera($nombreCarrera);
        $cursos = new Curso();
        $data["cursos"] = $cursos->buscarCursosPorCarrera($idCarrera);
        $cursos = new Tutor();
        $data["tutores"] = $cursos->buscarTutorDSW();
        $data['urlCode'] = 'some_value';
        return view('ListadoPracticasDSW/index', $data);
    }

    /*public function listarRegistros()
    {
        $practicas = new PracticasDSW();
        $data["listaPracDSW"] = $practicas->buscarEstudiantePracticaDSW();
        //$data["lista"] = $practicas->buscarRegistros();
        return view('ListadosPracticas/listaPracDSW', $data);
    }*/

    public function listarRegistros()
    {
        $practicas = new PracticasDSW();
        $data["lista"] = $practicas->buscarEstudiantePracticaDSW();
        //$data["lista"] = $practicas->buscarRegistros();
        return view('ListadoPracticasDSW/lista', $data);
    }

    public function gestionRegistro()
    {
        $idPracticasDSW =  $this->request->getPost("idPracticasDSW");
        $nombreEstudiante =  $this->request->getPost("nombreEstudiante");
        $carrera =  $this->request->getPost("carreraPracticas");

        $nCarrera = new Carrera();
        $carreraID = $nCarrera->idCarrera($carrera);

        $empresaPracticas =  $this->request->getPost("empresaPracticasUNO");
        $horasPracticas =  $this->request->getPost("horasPracticasUNO");
        $fechaInicio =  $this->request->getPost("fechaInicioUNO");
        $fechaFin =  $this->request->getPost("fechaFinUNO");
        $cursoPracticas =  $this->request->getPost("cursoPracticasUNO");
        $tutorPracticas =  $this->request->getPost("tutorPracticasUNO");
        $horasCum1 =  $this->request->getPost("horasCum1");
        $terminado =  $this->request->getPost("terminado");
        $empresaDOS =  $this->request->getPost("empresaDOS");
        $horasPracticasDOS =  $this->request->getPost("horasDOS");
        $fechaInicioDOS =  $this->request->getPost("fechaInicioDOS");
        $fechaFinDOS =  $this->request->getPost("fechaFinDOS");
        $cursoPracticasDOS =  $this->request->getPost("cursoPracticasDOS");
        $tutorPracticasDOS =  $this->request->getPost("tutorPracticasDOS");
        $horasCum2 =  $this->request->getPost("horasCum2");
        $terminadoDOS =  $this->request->getPost("terminadoDOS");

        $session = \Config\Services::session();
        $cargoUsuario = $session->get('cargoUsuario');

        $nombreAsignacion = 'PRACTICAS' or $cargoUsuario;
        $asignacion = new Asignacion();
        $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
        $data = [
            "Cedula" => $nombreEstudiante,
            "Carrera" => $carrera,
            "Empresa" => $empresaPracticas,
            "Horas" => $horasPracticas,
            "Fecha_Inicio" => $fechaInicio,
            "Fecha_Fin" => $fechaFin,
            "Curso" => $cursoPracticas,
            "Horas_Cum1" => $horasCum1,
            "Terminado" => $terminado,
            "Tutor_Academico" => $tutorPracticas,
            "Empresa2" => $empresaDOS,
            "Horas2" => $horasPracticasDOS,
            "Fecha_Inicio2" => $fechaInicioDOS,
            "Fecha_Fin2" => $fechaFinDOS,
            "Curso2" => $cursoPracticasDOS,
            "Horas_Cum2" => $horasCum2,
            "Terminado2" => $terminadoDOS,
            "Tutor_Academico2" => $tutorPracticasDOS, 
        ];
        $practicasDSW = new  PracticasDSW();
        $empresa = new Empresa();
        $existeEstudiantePracticas = $practicasDSW->existeUsuarioPracDSW($nombreEstudiante);
        $cuposDisponibles = $empresa->verificarCupos($empresaPracticas, $idAsignacion, $carreraID);

        if ($idPracticasDSW > 0) {
            $resultado = 'e|' . $practicasDSW->editarDSW($idPracticasDSW, $data);
        } else {
            if (!$existeEstudiantePracticas) {
                if ($cuposDisponibles <= 0) {
                    $resultado = 'd|';
                } else {
                    $empresa->restarCupo($empresaPracticas, $idAsignacion, $carreraID);
                    $resultado = 'i|' . $practicasDSW->insertarRegistro($data);
                }
            } else {
                $resultado = 'f|';
            }

        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idPracticasDSW = $this->request->getPost("idPracticasDSW");
        $practicas = new PracticasDSW();
        $resultado = $practicas->buscarRegistroPorID($idPracticasDSW);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idPracticasDSW = $this->request->getPost("idPracticasDSW");
        $practicas = new PracticasDSW();
        $resultado = $practicas->eliminarRegistro($idPracticasDSW);
        echo json_encode($resultado);
    }
}
