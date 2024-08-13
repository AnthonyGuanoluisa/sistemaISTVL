<?php

namespace App\Controllers;
use App\Models\CertificadosGenerados;
use App\Models\Certificado;
use App\Models\Matriz;
use App\Models\Usuario;
use App\Models\Carrera;
use PhpOffice\PhpWord\TemplateProcessor;

class CertificadosAprobados extends BaseController
{
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Certificados/index', $data);
    }

    public function indexGenerados()
    {

        $data['urlCode'] = 'some_value';
        return view('Certificados/indexGenerados', $data);
    }

    public function lista()
    {
        $urlCode = $this->request->getPost("urlCode");
        $certificado = new Certificado();
        $data["lista"] = $certificado->buscarRegistros();
        $data["urlCode"] = $urlCode;
        return view('Certificados/lista', $data);
    }
    public function enviarCertificadosAprobados()
    {
        
        if ($this->request->getMethod() === 'post') {
            $Cedula = $this->request->getPost('Cedula');
            $NombreCompleto = $this->request->getPost('NombreCompleto');
            $Carrera = $this->request->getPost('Carrera');
            $Certi = $this->request->getPost('Certi');
            $IdCertificados = $this->request->getPost('idCertificados');
    
            $data = [
                "Cedula" => $Cedula,
                "Estudiante" => $NombreCompleto,
                "Carrera" => $Carrera,
                "Num_Certificado" => $Certi,
                "idCerti" => $IdCertificados,
            ];

                
                $certificado = new CertificadosGenerados();
                $datosExistentes = $certificado->find($Certi);
    
                if ($datosExistentes) {
                    $resultado = 'i|';
                    echo json_encode([
                    'status' => 'warning',
                    'message' => 'El estudiante ya fue certificado. ¿Desea certificar nuevamente?',
                    'href' => base_url('generar-certificado/' . $IdCertificados ),
                    ]);
                    exit;
                } else {
                    $certificado->insertarRegistro($data);
                    echo json_encode([
                    'status' => 'success',
                    'message' => 'Certificado Exitosamente',
                    'href' => base_url('generar-certificado/' . $IdCertificados),
                ]);
                exit;
                }

        }
    }

    public function enviarCertificadosAprobadosDSW()
    {
        if ($this->request->getMethod() === 'post') {
            $Cedula = $this->request->getPost('Cedula');
            $NombreCompleto = $this->request->getPost('NombreCompleto');
            $Carrera = $this->request->getPost('Carrera');
            $Certi = $this->request->getPost('Certi');
            $IdCertificados = $this->request->getPost('idCertificados');
    
            $data = [
                "Cedula" => $Cedula,
                "Estudiante" => $NombreCompleto,
                "Carrera" => $Carrera,
                "Num_Certificado" => $Certi,
                "idCerti" => $IdCertificados,
            ];

            $certificado = new CertificadosGenerados();
            $datosExistentes = $certificado->find($Certi);


            if ($datosExistentes) {
                $resultado = 'i|';
                echo json_encode([
                    'status' => 'warning',
                    'message' => 'El estudiante ya fue certificado. ¿Desea certificar nuevamente?',
                    'href' => base_url('generar-certificadosDSW/' . $IdCertificados ),
                ]);
                exit;
            } else {
                $certificado->insertarRegistro($data);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Certificado Exitosamente',
                    'href' => base_url('generar-certificadosDSW/' . $IdCertificados),
                ]);
                exit;
            }
        }
    }
    
}
