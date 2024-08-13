<?php

namespace App\Controllers;

use App\Models\Matriz;

class Matrices extends BaseController
{
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Matriz/index', $data);
    }
    public function indexCoordinador()
    {
        $data['urlCode'] = 'some_value';
        return view('Matriz/indexCoordinador', $data);
    }

    public function indexVinculacion()
    {
        $data['urlCode'] = 'some_value';
        return view('Matriz/indexVinculacion', $data);;
    }

    public function indexPracticas()
    {
        $data['urlCode'] = 'some_value';
        return view('Matriz/indexPracticas', $data);;
    }

    public function listarRegistros()
    {
        $matriz = new Matriz();
        $data["lista"] = $matriz->buscarRegistros();
        return view('Matriz/lista', $data);
    }

    public function listarRegistrosAsignacion()
    {
        $matriz = new Matriz();
        $data["listaAsignacion"] = $matriz->buscarRegistros();
        return view('Matriz/listaAsignacion', $data);
    }

    public function gestionRegistro()
    {
        $idMatriz =  $this->request->getPost("idMatriz");
        $zonaMatriz =  $this->request->getPost("zonaMatriz");
        $provinciaMatriz =  $this->request->getPost("provinciaMatriz");
        $institutoMatriz =  $this->request->getPost("institutoMatriz");
        $convenioMatriz =  $this->request->getPost("convenioMatriz");
        $carreraMatriz =  $this->request->getPost("carreraMatriz");
        $beneficiariosCarrera =  $this->request->getPost("beneficiariosCarrera");
        $beneficiariosConvenio =  $this->request->getPost("beneficiariosConvenio");
        $aprovacionMatriz =  $this->request->getPost("aprovacionMatriz");
        $empresaMatriz =  $this->request->getPost("empresaMatriz");
        $naturalezaEmpresa =  $this->request->getPost("naturalezaEmpresa");
        $tipoEmpresaMatriz =  $this->request->getPost("tipoEmpresaMatriz");
        $representanteMatriz =  $this->request->getPost("representanteMatriz");
        $direccionMatriz =  $this->request->getPost("direccionMatriz");
        $correoMatriz =  $this->request->getPost("correoMatriz");
        $telefonoMatriz =  $this->request->getPost("telefonoMatriz");
        $sectorProductivo =  $this->request->getPost("sectorProductivo");
        $fechaSuscripcionMatriz =  $this->request->getPost("fechaSuscripcionMatriz");
        $fechaTerminacionMatriz =  $this->request->getPost("fechaTerminacionMatriz");
        $data = [
            "zona" => $zonaMatriz,
            "Provincia" => $provinciaMatriz,
            "Instituto" => $institutoMatriz,
            "Convenio" => $convenioMatriz,
            "Carrera" => $carreraMatriz,
            "Beneficiarios_carrera" => $beneficiariosCarrera,
            "Beneficiarios_convenio" => $beneficiariosConvenio,
            "Aprovacion" => $aprovacionMatriz,
            "Empresa" => $empresaMatriz,
            "Naturaleza_empresa" => $naturalezaEmpresa,
            "Tipo_empresa" => $tipoEmpresaMatriz,
            "Representante_empresa" => $representanteMatriz,
            "Direccion_empresa" => $direccionMatriz,
            "Correo_empresa" => $correoMatriz,
            "Telefono_empresa" => $telefonoMatriz,
            "Sector_Productivo" => $sectorProductivo,
            "Fecha_suscripcion" => $fechaSuscripcionMatriz,
            "Fecha_terminacion" => $fechaTerminacionMatriz,
        ];
        $matriz = new Matriz();

        if ($idMatriz > 0) {
            $resultado = 'e|' . $matriz->editarRegistro($idMatriz, $data);
        } else {
            $resultado = 'i|' . $matriz->insertarRegistro($data);
        }
        echo json_encode($resultado);
    }

    public function buscarRegistroPorID()
    {
        $idMatriz = $this->request->getPost("idMatriz");
        $matriz = new Matriz();
        $resultado = $matriz->buscarRegistroPorID($idMatriz);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idMatriz = $this->request->getPost("idMatriz");
        $matriz = new Matriz();
        $resultado = $matriz->eliminarRegistro($idMatriz);
        echo json_encode($resultado);
    }

    
}
