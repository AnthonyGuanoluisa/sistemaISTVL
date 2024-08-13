<?php

namespace App\Controllers;

use App\Models\Tutor;
use App\Models\Carrera;
use App\Models\Usuario;
use App\Models\Jornada;

class Tutores extends BaseController
{
    public function index()
    {
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        return view('Tutores/index', $data);
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
        $jornada = new Jornada();
        $data["jornada"] = $jornada->buscarJornada();
        $data['urlCode'] = 'some_value';
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Tutores/indexPracticas', $data);
    }
    public function listarRegistros()
    {
        $tutor = new Tutor();
        $data["lista"] = $tutor->buscarRegistros();
        return view('Tutores/lista', $data);
    }

        public function listarRegistro()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario();
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $tutor = new Tutor();
        $data["lista"] = $tutor->buscarTutoresPorCarrera($carreraUsuario);
        return view('Tutores/lista', $data);
    }
    public function gestionRegistro()
    {
        $cedulaTutor = $this->request->getPost("cedulaTutor");
        $nombreTutor = $this->request->getPost("nombreTutor");
        $apellidoTutor = $this->request->getPost("apellidoTutor");
        $direccionTutor = $this->request->getPost("direccionTutor");
        $telefonoTutor = $this->request->getPost("telefonoTutor");
        $correoTutor = $this->request->getPost("correoTutor");
        $carreraTutor = $this->request->getPost("carreraTutor");
        $jornadaTutor = $this->request->getPost("jornadaTutor");
        $vigencia = $this->request->getPost("vigencia");
    
        $data = [
            "id" => $cedulaTutor,
            "Nombres" => $nombreTutor,
            "Apellidos" => $apellidoTutor,
            "Direccion" => $direccionTutor,
            "Telefono" => $telefonoTutor,
            "Correo" => $correoTutor,
            "Carrera" => $carreraTutor,
            "Jornada" => $jornadaTutor,
            "Vigente" => $vigencia
        ];
    
        if ($this->validarCedula($cedulaTutor)) {
            $tutor = new Tutor();
            $cedulaTutores = $tutor->find($cedulaTutor);
        
            if ($cedulaTutores) {
                $resultado = 'e|' . $tutor->editarRegistro($cedulaTutor, $data);
            } else {
                $resultado = 'i|' . $tutor->insertarRegistro($data);
            }
        
        }else{
            $resultado = 'd|';
        }
    
        echo json_encode($resultado);
    }

    private function validarCedula($cedulaTutor) {
        if (strlen($cedulaTutor) == 10) {
            // Validación de cédula
            $digito_region = substr($cedulaTutor, 0, 2);
    
            if ($digito_region >= 1 && $digito_region <= 24) {
                $ultimo_digito = substr($cedulaTutor, 9, 1);
                $pares = intval($cedulaTutor[1]) + intval($cedulaTutor[3]) + intval($cedulaTutor[5]) + intval($cedulaTutor[7]);
    
                $impares = 0;
                for ($i = 0; $i < 9; $i += 2) {
                    $numero = $cedulaTutor[$i] * 2;
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
        } elseif (strlen($cedulaTutor) == 9) {
            // Validación de pasaporte
            return preg_match('/^[a-zA-Z0-9]{9}$/', $cedulaTutor) === 1;
        } else {
            return false;
        }
    }

    public function buscarRegistroPorID()
    {
        $cedulaTutor = $this->request->getPost("cedulaTutor");
        $tutor = new Tutor();
        $resultado = $tutor->buscarRegistroPorID($cedulaTutor);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $cedulaTutor = $this->request->getPost("cedulaTutor");
        $tutor = new Tutor();
        $resultado = $tutor->eliminarRegistro($cedulaTutor);
        echo json_encode($resultado);
    }

    public function buscarTutoresCarrera()
    {
        $carreraTutor = $this->request->getPost("carreraTutor");
        $tutor = new Tutor();
        $resultado = $tutor->buscarTutorPorCarrera($carreraTutor);
        echo json_encode($resultado);
    }
}
