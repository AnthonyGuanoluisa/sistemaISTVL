<?php

namespace App\Controllers;
use App\Models\CertificadoDSW;
use App\Models\Matriz;
use App\Models\Carrera;
use App\Models\Asignacion;
use App\Models\Usuario;
use App\Models\Empresa;

use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;


class CertificadosDSW extends BaseController
{

    public function listarRegistros()
    {
        $urlCode = $this->request->getPost("urlCode");
        $certificadoDSW = new CertificadoDSW();
        $data["lista"] = $certificadoDSW->buscarRegistrosSIN();
        $data["urlCode"] = $urlCode;
        return view('Certificados/listaDSW', $data);
    }

    public function gestionRegistro()
    {
        $idCertificado =  $this->request->getPost("idCertificado");
        $estudianteCertificado =  $this->request->getPost("estudianteCertificado");
        $cedulaCertificado =  $this->request->getPost("cedulaCertificado");
        $carreraCertificado =  $this->request->getPost("carreraCertificado");
        $empresaPracticasUno =  $this->request->getPost("empresaPracticasUno");
        $inicioPracticasUno =  $this->request->getPost("inicioPracticasUno");
        $horasPracticasUno =  $this->request->getPost("finPracticasUno");
        $finPracticasUno =  $this->request->getPost("horasPracticasUno");
        $empresaPracticasDos =  $this->request->getPost("empresaPracticasDos");
        $inicioPracticasDos =  $this->request->getPost("inicioPracticasDos");
        $finPracticasDos =  $this->request->getPost("finPracticasDos");
        $horasPracticasDos =  $this->request->getPost("horasPracticasDos");
        $empresaVinculacion =  $this->request->getPost("empresaVinculacion");
        $inicioVinculacion =  $this->request->getPost("inicioVinculacion");
        $finVinculacion =  $this->request->getPost("finVinculacion");
        $horasVinculacion =  $this->request->getPost("horasVinculacion");
        $horasCompletadas =  $this->request->getPost("horasCompletadas");
        $data = [
            "Estudiante" => $estudianteCertificado,
            "Cedula" => $cedulaCertificado,
            "Carrera" => $carreraCertificado ,
            "Empresa_1erP" => $empresaPracticasUno ,
            "Fecha_Inicio_1erP" => $inicioPracticasUno,
            "Fecha_Fin_1erP" => $finPracticasUno,
            "Horas_1erP" => $horasPracticasUno,
            "Empresa_2erP" => $empresaPracticasDos,
            "Fecha_Inicio_2erP" => $inicioPracticasDos,
            "Fecha_Fin_2erP" => $finPracticasDos,
            "Horas_2erP" => $horasPracticasDos,
            "Empresa_Vinculacion" => $empresaVinculacion,
            "Fecha_Inicio_Vinculacion" => $inicioVinculacion,
            "Fecha_Finalizacion_Vinculacion" => $finVinculacion,
            "Horas_Vinculacion" => $horasVinculacion,
            "Horas_Completadas" => $horasCompletadas,
        ];

        $certificadoDSW = new CertificadoDSW();
        $codigoCarrera = $data["NumCerti"];
        if ($idCertificado > 0) {
            $resultado = 'e|' . $certificadoDSW->editarRegistroDSW($idCertificado, $data);
        } else {
                $resultado = 'i|' . $certificadoDSW->insertarRegistro($data,$codigoCarrera);
        }
        echo json_encode($resultado);
        
    }

    public function buscarRegistroPorID()
    {
        $idCertificado = $this->request->getPost("idCertificado");
        $certificadoDSW = new CertificadoDSW();
        $resultado = $certificadoDSW->buscarRegistroPorID($idCertificado);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idCertificado = $this->request->getPost("idCertificado");
        $certificadoDSW = new CertificadoDSW();
        $resultado = $certificadoDSW->eliminarRegistro($idCertificado);
        echo json_encode($resultado);
    }

    public function enviarAprobadoPracticasDSW()
    {
        if ($this->request->getMethod() === 'post') {
            $Cedula = $this->request->getPost('Cedula');
            $NombreCompleto = $this->request->getPost('NombreCompleto');
            $Empresa1 = $this->request->getPost('Empresa');
            $Fecha_fin1 = $this->request->getPost('Fecha_fin');
            $Fecha_Inicio1 = $this->request->getPost('Fecha_Inicio');
            $Horas1 = $this->request->getPost('Horas');

            $Empresa2 = $this->request->getPost('Empresa2');
            $Fecha_fin2 = $this->request->getPost('Fecha_fin2');
            $Fecha_Inicio2 = $this->request->getPost('Fecha_Inicio2');
            $Horas2 = $this->request->getPost('Horas2');
            
            $Carrera = $this->request->getPost('Carrera');

            $Ncarrera = new Carrera();
            $codigoCarrera = $Ncarrera->CodigoCarrera($Carrera);
            $idCarrera = $Ncarrera->idCarrera($Carrera);

            $data = [
                "Estudiante" => $NombreCompleto,
                "Cedula" => $Cedula,
                "Carrera" => $Carrera,
                "Empresa_1erP" => $Empresa1,
                "Fecha_Inicio_1erP" => $Fecha_Inicio1,
                "Fecha_Fin_1erP" => $Fecha_fin1,
                "Horas_1erP" => $Horas1,
                "Empresa_2erP" => $Empresa2,
                "Fecha_Inicio_2erP" => $Fecha_Inicio2,
                "Fecha_Fin_2erP" => $Fecha_fin2,
                "Horas_2erP" => $Horas2,
            ];

            $certificadoDSW = new CertificadoDSW();
            $datosExistentes = $certificadoDSW->where('Cedula', $Cedula)->first();
            $session = \Config\Services::session();
            $cargoUsuario = $session->get('cargoUsuario');
            $nombreAsignacion = $cargoUsuario;
            $asignacion = new Asignacion();
            $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
            $empresa = new Empresa();


            if ($datosExistentes) {
                if ( !empty($datosExistentes['Empresa_1erP']) || !empty($datosExistentes['Fecha_Inicio_1erP']) || !empty($datosExistentes['Fecha_Fin_1erP']) || !empty($datosExistentes['Horas_1erP']) || !empty($datosExistentes['Empresa_2erP']) || !empty($datosExistentes['Fecha_Inicio_2erP']) || !empty($datosExistentes['Fecha_Fin_2erP']) || !empty($datosExistentes['Horas_2erP'])) {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'El estudiante ya fue Aprobado.']);
                } else {
                    $certificadoDSW->actualizarRegistro($Cedula, $data);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
                }
            } else {
                $empresa->sumarCupo($Empresa1, $idAsignacion, $idCarrera);
                $empresa->sumarCupo($Empresa2, $idAsignacion, $idCarrera);
                $certificadoDSW->insertarRegistro($data,$codigoCarrera);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
            }
        }
    }
}
