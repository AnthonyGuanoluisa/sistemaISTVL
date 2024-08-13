<?php

namespace App\Controllers;

use App\Models\Usuario;

class Login extends BaseController
{
    public function index()
    {
        //echo session()->getFlashdata('msg');
        return view('Login/index');
    }

   
    public function validarIngreso()
    {
        $Usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
    
        $passwordEncriptada = md5($password);
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->where('Cedula', $Usuario)->where('Contraseña', $passwordEncriptada)->first();
        if ($usuario) {
            $idUsuario = $usuario['id'];
            $datosUsu = $usuarioModel->buscarUsuario($idUsuario);
            $cargoNombre = $datosUsu->cargoUsuario;
    
            $data = [
                "idUsuario" => $idUsuario,
                "nombreUsuario" => $datosUsu->nombreUsuario,
                "cedulaUsuario" => $datosUsu->cedulaUsuario,
                "cargoUsuario" => $datosUsu->cargoUsuario,
                "carreraUsuario" => $datosUsu->carreraUsuario ?? '',
                "idCarrera" => $datosUsu->idCarrera ?? 0
            ];
            session()->set($data);
    
            switch ($cargoNombre) {
                case 'ADMINISTRADOR':
                    return redirect()->to(base_url('administrador'));
                    break;
                case 'COORDINADOR':
                    return redirect()->to(base_url('coordinador'));
                    break;
                case 'VINCULACION':
                    return redirect()->to(base_url('vinculacion'));
                    break;
                case 'PRACTICAS':
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
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

   
}
