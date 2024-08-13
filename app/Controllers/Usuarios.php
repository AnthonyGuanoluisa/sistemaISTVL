<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Carrera;
use App\Models\Cargo;

class Usuarios extends BaseController
{
    public function index()
    {
        $tipoCargo = new Cargo();
        $data["tipoCargo"] = $tipoCargo->buscarCargos();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarreras();
        $data['urlCode'] = 'some_value';
        return view('Usuarios/index', $data);
    }

    public function listarRegistros()
    {
        $usuario = new Usuario();
        $data["lista"] = $usuario->buscarRegistros();
        return view('Usuarios/lista', $data);
    }

    public function gestionRegistro()
    {
        $idUsuario =  $this->request->getPost("idUsuario");
        $nombreUsuario =  $this->request->getPost("nombreUsuario");
        $cedulaUsuario =  $this->request->getPost("cedulaUsuario");
        $claveUsuario =  $this->request->getPost("claveUsuario");
        $confirClave =  $this->request->getPost("confirClave");
        $cargoUsuario =  $this->request->getPost("cargoUsuario");
        $carreraUsuario =  $this->request->getPost("carreraUsuario");

        $claveUsuarioEncriptada = md5($claveUsuario);
        $data = [
            "Usuario" => $nombreUsuario,
            "Cedula" => $cedulaUsuario,
            "Contraseña" => $claveUsuarioEncriptada ,
            "Confir_Contraseña" => $confirClave ,
            "Cargo" => $cargoUsuario,
            "carrera" => $carreraUsuario,
        ];

        if ($this->validarCedula($cedulaUsuario)) {

            $usuario = new Usuario();
            $existeUsuario = $usuario->existeUsuario($cedulaUsuario);

            if ($idUsuario > 0) {
                $resultado = 'e|' . $usuario->editarRegistro($idUsuario, $data);
            } else {
                if ($existeUsuario) {
                    $resultado = 'd|El usuario ya existe';
                } else {
                    $resultado = 'i|' . $usuario->insertarRegistro($data);
                }
            }
            }else{
                $resultado = 'f|';
            }

        echo json_encode($resultado);
        
    }

    private function validarCedula($cedulaUsuario) {
        if (strlen($cedulaUsuario) == 10) {
            // Validación de cédula
            $digito_region = substr($cedulaUsuario, 0, 2);
    
            if ($digito_region >= 1 && $digito_region <= 24) {
                $ultimo_digito = substr($cedulaUsuario, 9, 1);
                $pares = intval($cedulaUsuario[1]) + intval($cedulaUsuario[3]) + intval($cedulaUsuario[5]) + intval($cedulaUsuario[7]);
    
                $impares = 0;
                for ($i = 0; $i < 9; $i += 2) {
                    $numero = $cedulaUsuario[$i] * 2;
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
        } elseif (strlen($cedulaUsuario) == 9) {
            // Validación de pasaporte
            return preg_match('/^[a-zA-Z0-9]{9}$/', $cedulaUsuario) === 1;
        } else {
            return false;
        }
    }
    public function buscarRegistroPorID()
    {
        $idUsuario = $this->request->getPost("idUsuario");
        $usuario = new Usuario();
        $resultado = $usuario->buscarRegistroPorID($idUsuario);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idUsuario = $this->request->getPost("idUsuario");
        $usuario = new Usuario();
        $resultado = $usuario->eliminarRegistro($idUsuario);
        echo json_encode($resultado);
    }
}
