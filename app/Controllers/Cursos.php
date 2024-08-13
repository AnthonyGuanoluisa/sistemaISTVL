<?php

namespace App\Controllers;

use App\Models\Nivel;
use App\Models\Periodo;
use App\Models\Jornada;
use App\Models\Curso;
use App\Models\Carrera;
use App\Models\Usuario;

class Cursos extends BaseController
{
    public function index()
    {
        $niveles = new Nivel();
        $data["niveles"] = $niveles->buscarNivel();
        $cicloAca = new Periodo();
        $data["periodos"] = $cicloAca->buscarPeriodo();
        $jornadas = new Jornada();
        $data["jornadas"] = $jornadas->buscarJornada();
        $carreras = new Carrera();
        $data["carreras"] = $carreras->buscarCarrerasParaCursos();
        $data['urlCode'] = 'some_value';
        return view('Cursos/index', $data);
    }

    public function indexPracticas()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario;
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $niveles = new Nivel();
        $data["niveles"] = $niveles->buscarNivel();
        $cicloAca = new Periodo();
        $data["periodos"] = $cicloAca->buscarPeriodo();
        $jornadas = new Jornada();
        $data["jornadas"] = $jornadas->buscarJornada();
        $carreras = new Carrera();
        $datosCarrera = $carreras->find($carreraUsuario);
        $data['urlCode'] = 'some_value';
        $data['carreraUsuario'] = $carreraUsuario;
        $data['nombreCarreraUsuario'] = $datosCarrera['Nombre_Carrera'];
        return view('Cursos/indexPracticas', $data);
    }

    public function listarRegistros()
    {
        $curso = new Curso();
        $data["lista"] = $curso->buscarCursos();
        return view('Cursos/lista', $data);
    }

    public function listarRegistro()
    {
        $session = \Config\Services::session();
        $usuarioId = $session->get('idUsuario');
        $usuario = new Usuario();
        $datosUsuario = $usuario->find($usuarioId);
        $carreraUsuario = $datosUsuario['carrera'];
        $curso = new Curso();
        $data["lista"] = $curso->buscarCursosPorCarrera($carreraUsuario);
        return view('Cursos/lista', $data);
    }

    public function gestionRegistro()
    {
        $idCurso =  $this->request->getPost("idCurso");
        $nombreCurso =  $this->request->getPost("nombreCurso");
        $nivelCurso =  $this->request->getPost("nivelCurso");
        $cicloCurso =  $this->request->getPost("cicloCurso");
        $jornadaCurso =  $this->request->getPost("jornadaCurso");
        $carrera =  $this->request->getPost("carreraCurso");
        $data = [
            "Cursos" => $nombreCurso,
            "Nivel" => $nivelCurso,
            "Ciclo_Academico" => $cicloCurso,
            "Jornada" => $jornadaCurso,
            "Carrera" => $carrera,
        ];
        $cursos = new Curso();

        if ($idCurso > 0) {
            $resultado = 'e|' . $cursos->editarRegistro($idCurso, $data);
        } else {
            $resultado = 'i|' . $cursos->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idCurso = $this->request->getPost("idCurso");
        $curso = new Curso();
        $resultado = $curso->buscarRegistroPorID($idCurso);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idCurso = $this->request->getPost("idCurso");
        $curso = new curso();
        $resultado = $curso->eliminarRegistro($idCurso);
        echo json_encode($resultado);
    }

    public function buscarCursosCarrera()
    {
        $idCarrera = $this->request->getPost("carreraCurso"); 
        $estudiante = new Curso();
        $resultado = $estudiante->buscarCursosPorCarrera($idCarrera);
        echo json_encode($resultado); 
    }
}
