<?php

namespace App\Controllers;

use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\Carrera;
use App\Models\Jornada;
use App\Models\Usuario;

class Estudiantes extends BaseController
{
    public function index()
    {
        $ciclo = new Periodo();
        $data["ciclo"] = $ciclo->buscarPeriodo();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        return view('Estudiantes/index', $data);
    }
    public function indexCoordinador()
    {
        $ciclo = new Periodo();
        $data["ciclo"] = $ciclo->buscarPeriodo();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        return view('Estudiantes/indexCoordinador', $data);
    }

    public function indexVinculacion()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $ciclo = new Periodo();
        $data["ciclo"] = $ciclo->buscarPeriodo();
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Estudiantes/indexVinculacion', $data);
    }

    public function indexPracticas()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $ciclo = new Periodo();
        $data["ciclo"] = $ciclo->buscarPeriodo();
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Estudiantes/indexPracticas', $data);
    }

    public function listarRegistros()
    {
        $estudiante = new Estudiante();
        $data['lista'] = $estudiante->buscarRegistros(); 
        return view('Estudiantes/lista', $data);
    }
    

    public function listarRegistrosAsignacion()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario();
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $estudiante = new Estudiante();
        $data["listaAsignacion"] = $estudiante->buscarEstudiantePorCarrera($carreraUsuario);
        return view('Estudiantes/listaAsignacion', $data);
    }

    public function gestionRegistro()
    {
        $cedulaEstudiante =  $this->request->getPost("cedulaEstudiante");
        $nombresEstudiante =  $this->request->getPost("nombresEstudiante");
        $apellidosEstudiante =  $this->request->getPost("apellidosEstudiante");
        $sexoEstudiante =  $this->request->getPost("sexoEstudiante");
        $cicloEstudinte =  $this->request->getPost("cicloEstudinte");
        $carreraEstudiante =  $this->request->getPost("carreraEstudiante");
        $jornadaEstudiante =  $this->request->getPost("jornadaEstudiante");
        $correoEstudiante =  $this->request->getPost("correoEstudiante");
        $telefonoEstudiante =  $this->request->getPost("telefonoEstudiante");
        $data = [
            "id" => $cedulaEstudiante,
            "Nombres" => $nombresEstudiante,
            "Apellidos" => $apellidosEstudiante,
            "Sexo" => $sexoEstudiante,
            "Ciclo_Academico" => $cicloEstudinte,
            "Carrera" => $carreraEstudiante,
            "correo" => $correoEstudiante,
            "telefono" => $telefonoEstudiante,
            "Jornada" => $jornadaEstudiante
        ];

        if ($this->validarCedula($cedulaEstudiante)) {
            $estudiante = new Estudiante();
            $existeUsuario = $estudiante->buscarRegistroPorID($cedulaEstudiante);
        
            if ($existeUsuario) {
                $resultado = 'e|' . $estudiante->editarRegistro($cedulaEstudiante, $data);
            } else {
                $resultado = 'i|' . $estudiante->insertarRegistro($data);
            }
        } else {
            $resultado = 'd|';
        }
        echo json_encode($resultado);
    }

    private function validarCedula($cedulaEstudiante) {
        if (strlen($cedulaEstudiante) == 10) {
            // Validación de cédula
            $digito_region = substr($cedulaEstudiante, 0, 2);
    
            if ($digito_region >= 1 && $digito_region <= 24) {
                $ultimo_digito = substr($cedulaEstudiante, 9, 1);
                $pares = intval($cedulaEstudiante[1]) + intval($cedulaEstudiante[3]) + intval($cedulaEstudiante[5]) + intval($cedulaEstudiante[7]);
    
                $impares = 0;
                for ($i = 0; $i < 9; $i += 2) {
                    $numero = $cedulaEstudiante[$i] * 2;
                    if ($numero > 9) {
                        $numero -= 9;
                    }
                    $impares += $numero;
                }
    
                $suma_total = $pares + $impares;
                $decena = (ceil($suma_total / 10)) * 10;
                $digito_validador = $decena - $suma_total;
    
                if ($digito_validador == 10) {
                    $digito_validador = 0;
                }
    
                return $digito_validador == $ultimo_digito;
            } else {
                return false;
            }
        } elseif (strlen($cedulaEstudiante) == 9) {
            // Validación de pasaporte
            return preg_match('/^[a-zA-Z0-9]{9}$/', $cedulaEstudiante) === 1;
        } else {
            return false;
        }
    }

    public function buscarRegistroPorID()
    {
        $cedulaEstudiante = $this->request->getPost("cedulaEstudiante");
        $estudiante = new Estudiante();
        $resultado = $estudiante->buscarRegistroPorID($cedulaEstudiante);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $cedulaEstudiante = $this->request->getPost("cedulaEstudiante");
        $estudiante = new Estudiante();
        $resultado = $estudiante->eliminarRegistro($cedulaEstudiante);
        echo json_encode($resultado);
    }

    public function buscarEstudianteCarrera()
    {
        $idCarrera = $this->request->getPost("carreraEstudiante"); 
        $estudiante = new Estudiante();
        $resultado = $estudiante->buscarEstudiantePorCarrera($idCarrera);
        echo json_encode($resultado); 
    }
}
