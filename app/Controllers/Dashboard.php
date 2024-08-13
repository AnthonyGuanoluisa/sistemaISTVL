<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function administrador()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('cargoUsuario');

        if($usuarioId == "ADMINISTRADOR"){
            $data['urlCode'] = 'some_value';
            return view('Dashboard/administrador', $data);
        }else{
            return view('Mensaje/mensaje');
        }

    }

    public function coordinador()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('cargoUsuario');

        if($usuarioId == "COORDINADOR"){
            $data['urlCode'] = 'some_value';
            return view('Dashboard/coordinador', $data);
        }else{
            return view('Mensaje/mensaje');
        }
       
    }

    public function vinculacion()
    {   
        $session = \Config\Services::session();
        $usuarioId = $session->get('cargoUsuario');

        if($usuarioId == "VINCULACION"){
            $data['urlCode'] = 'some_value';
            return view('Dashboard/vinculacion', $data);
        }else{
            return view('Mensaje/mensaje');
        }
       
    }

    public function practicas()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('cargoUsuario');

        if($usuarioId == "PRACTICAS"){
            $data['urlCode'] = 'some_value';
            return view('Dashboard/practicas', $data);;
        }else{
            return view('Mensaje/mensaje');
        }
       
    }
}
