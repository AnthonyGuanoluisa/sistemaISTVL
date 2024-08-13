<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;

class Access extends BaseController
{

    public function adminAccess($Usuario, $password)
    {
        $passwordEncriptada = md5($password);
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->where('Cedula', $Usuario)->where('Contraseña', $passwordEncriptada)->first();
        if ($usuario) {
            $idUsuario = $usuario['id'];
            $datosUsu = $usuarioModel->buscarUsuario($idUsuario);
            $cargoNombre = $datosUsu->cargoUsuario;
    
            switch ($cargoNombre) {
                case 'ADMINISTRADOR':
                    $data = [
                        "idUsuario" => $idUsuario,
                        "nombreUsuario" => $datosUsu->nombreUsuario,
                        "cedulaUsuario" => $datosUsu->cedulaUsuario,
                        "cargoUsuario" => $datosUsu->cargoUsuario,
                    ];
                    session()->set($data);
                    return redirect()->to(base_url('administrador'));
                    break;
                    case 'COORDINADOR':
                        $data = [
                            "idUsuario" => $idUsuario,
                            "nombreUsuario" => $datosUsu->nombreUsuario,
                            "cedulaUsuario" => $datosUsu->cedulaUsuario,
                            "cargoUsuario" => $datosUsu->cargoUsuario,
                        ];
                        session()->set($data);
                        return redirect()->to(base_url('coordinador'));
                        break;    
                case 'VINCULACION':
                    $data = [
                        "idUsuario" => $idUsuario,
                        "nombreUsuario" => $datosUsu->nombreUsuario,
                        "cedulaUsuario" => $datosUsu->cedulaUsuario,
                        "cargoUsuario" => $datosUsu->cargoUsuario,
                        "carreraUsuario" => $datosUsu->carreraUsuario,
                        "idCarrera" => $datosUsu->idCarrera
                    ];
                    session()->set($data);
                    return redirect()->to(base_url('vinculacion'));
                    break;
                case 'PRACTICAS':
                    $data = [
                        "idUsuario" => $idUsuario,
                        "nombreUsuario" => $datosUsu->nombreUsuario,
                        "cedulaUsuario" => $datosUsu->cedulaUsuario,
                        "cargoUsuario" => $datosUsu->cargoUsuario,
                        "carreraUsuario" => $datosUsu->carreraUsuario,
                        "idCarrera" => $datosUsu->idCarrera
                    ];
                    session()->set($data);
                    return redirect()->to(base_url('practicas'));
                    break;
                default:
                    session()->setFlashdata('msg', 'Credenciales inválidas');
                    return redirect()->back();
                    break;
            }
        } else {
            session()->setFlashdata('msg', 'Credenciales inválidas');
            return redirect()->back();
        }

    }


}
