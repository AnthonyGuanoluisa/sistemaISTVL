<?php

namespace App\Controllers;
use App\Models\CertificadosGenerados;
use App\Models\Certificado;
use App\Models\CertificadoDSW;
use App\Models\Matriz;
use App\Models\Asignacion;
use App\Models\Usuario;
use App\Models\Carrera;
use App\Models\Empresa;
use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;

class Certificados extends BaseController
{
    
    public function index()
    {
        $data['urlCode'] = 'some_value';
        return view('Certificados/index', $data);
    }

    public function indexCoordinador()
    {
        $data['urlCode'] = 'some_value';
        return view('Certificados/indexCoordinador', $data);
    }

    public function indexGenerados()
    {
        $urlCode = $this->request->getPost("urlCode");
        $certificado = new CertificadosGenerados();
        $data["lista"] = $certificado->buscarRegistros();
        $data["listaDSW"] = $certificado->buscarRegistrosDSW();
        $data['urlCode'] = 'some_value';
        return view('Certificados/indexGenerados', $data);
    }

    public function indexGenerado()
    {
        $urlCode = $this->request->getPost("urlCode");
        $certificado = new CertificadosGenerados();
        $data["lista"] = $certificado->buscarRegistros();
        $data["listaDSW"] = $certificado->buscarRegistrosDSW();
        $data['urlCode'] = 'some_value';
        return view('Certificados/indexGenerado', $data);
    }

    public function listarRegistros()
    {
        $urlCode = $this->request->getPost("urlCode");
        $certificado = new Certificado();
        $data["lista"] = $certificado->buscarRegistrosSIN();
        $data["urlCode"] = $urlCode;
        return view('Certificados/lista', $data);
    }

    public function gestionRegistro()
    {
        $idCertificados =  $this->request->getPost("idCertificados");
        $estudianteCertificados =  $this->request->getPost("estudianteCertificados");
        $cedulaCertificados =  $this->request->getPost("cedulaCertificados");
        $carreraCertificados =  $this->request->getPost("carreraCertificados");
        $empresaPracticas =  $this->request->getPost("empresaPracticas");
        $inicioPracticas =  $this->request->getPost("inicioPracticas");
        $horasPracticas =  $this->request->getPost("finPracticas");
        $finPracticas =  $this->request->getPost("horasPracticas");
        $empresaVinculacion =  $this->request->getPost("empresaVinculacion");
        $inicioVinculacion =  $this->request->getPost("inicioVinculacion");
        $finVinculacion =  $this->request->getPost("finVinculacion");
        $horasVinculacion =  $this->request->getPost("horasVinculacion");
        $horasCompletadas =  $this->request->getPost("horasCompletadas");
        $numCertificado =  $this->request->getPost("numCertificado");
        $data = [
            "Estudiante" => $estudianteCertificados,
            "cedula" => $cedulaCertificados,
            "carrera" => $carreraCertificados ,
            "Empresa_Practicas" => $empresaPracticas ,
            "Fecha_Inicio_Practicas" => $inicioPracticas,
            "Fecha_Finalizacion_Practicas" => $finPracticas,
            "Horas_Practicas" => $horasPracticas,
            "Empresa_Vinculacion" => $empresaVinculacion,
            "Fecha_Inicio_Vinculacion" => $inicioVinculacion,
            "Fecha_Finalizacion_Vinculacion" => $finVinculacion,
            "Horas_Vinculacion" => $horasVinculacion,
            "Horas_Completadas" => $horasCompletadas,
            "Num_Certificado" => $numCertificado,
        ];

        $certificado = new Certificado();
        $codigoCarrera = $data["Num_Certificado"];
        if ($idCertificados > 0) {
            $resultado = 'e|' . $certificado->editarRegistroGeneral($idCertificados, $data);
        } else {
                $resultado = 'i|' . $certificado->insertarRegistro($data, $codigoCarrera);
        }
        echo json_encode($resultado);
        
    }

    public function buscarRegistroPorID()
    {
        $idCertificados = $this->request->getPost("idCertificados");
        $certificado = new Certificado();
        $resultado = $certificado->buscarRegistroPorID($idCertificados);
        echo json_encode($resultado);
    }

    public function eliminarRegistro()
    {
        $idCertificados = $this->request->getPost("idCertificados");
        $certificado = new Certificado();
        $resultado = $certificado->eliminarRegistro($idCertificados);
        echo json_encode($resultado);
    }


    public function enviarAprobadoVinculacion()
    {
        if ($this->request->getMethod() === 'post') {
            $Cedula = $this->request->getPost('Cedula');
            $NombreCompleto = $this->request->getPost('NombreCompleto');
            $Empresa = $this->request->getPost('Empresa');
            $Fecha_fin = $this->request->getPost('Fecha_fin');
            $Fecha_Inicio = $this->request->getPost('Fecha_Inicio');
            $Horas = $this->request->getPost('Horas');
            $Carrera = $this->request->getPost('Carrera');
            $Ncarrera = new Carrera();
            $codigoCarrera = $Ncarrera->CodigoCarrera($Carrera);
            $idCarrera = $Ncarrera->idCarrera($Carrera);
            $data = [
                "cedula" => $Cedula,
                "Estudiante" => $NombreCompleto,
                "Carrera" => $Carrera,
                "Empresa_Vinculacion" => $Empresa,
                "Fecha_Inicio_Vinculacion" => $Fecha_Inicio,
                "Fecha_Finalizacion_Vinculacion" => $Fecha_fin,
                "Horas_Vinculacion" => $Horas,
            ];
    
            $certificadoVinculacion = new Certificado();
            $datosVinculacion = $certificadoVinculacion->where('cedula', $Cedula)->first();

            $certificadoDSW = new CertificadoDSW();
            $datosExistentesDSW = $certificadoDSW->where('Cedula', $Cedula)->first();

            $session = \Config\Services::session();
            $cargoUsuario = $session->get('cargoUsuario');
            $nombreAsignacion = $cargoUsuario;
            $asignacion = new Asignacion();
            $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);

            if ($Carrera == 'DESARROLLO DE SOFTWARE') {
                return $this->procesarVinDSW($datosExistentesDSW, $certificadoDSW, $Cedula, $data, $codigoCarrera, $Empresa, $idAsignacion, $idCarrera);
            } else {
                return $this->procesarAprobacionVin($datosVinculacion, $certificadoVinculacion, $Cedula, $data, $codigoCarrera, $Empresa, $idAsignacion, $idCarrera);               
            }
        }
    }
    
    public function procesarVinDSW($datosExistentesDSW, $certificadoDSW, $Cedula, $data, $codigoCarrera, $Empresa, $idAsignacion, $idCarrera)
    {
        $empresa = new Empresa();
        if ($datosExistentesDSW) {
            if (!empty($datosExistentesDSW['Empresa_Vinculacion']) || !empty($datosExistentesDSW['Fecha_Inicio_Vinculacion']) || !empty($datosExistentesDSW['Fecha_Finalizacion_Vinculacion']) || !empty($datosExistentesDSW['Horas_Vinculacion'])) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'El estudiante ya fue Aprobado.']);
            } else {
                $certificadoDSW->actualizarRegistro($Cedula, $data);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
            }
        } else {
            $empresa->sumarCupo($Empresa, $idAsignacion, $idCarrera);
            $certificadoDSW->insertarRegistro($data, $codigoCarrera);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
        }
    }

    public function procesarAprobacionVin($datosVinculacion, $certificadoVinculacion, $Cedula, $data, $codigoCarrera, $Empresa, $idAsignacion, $idCarrera)
    {
        $empresa = new Empresa();
        if ($datosVinculacion) {
            if (!empty($datosVinculacion['Empresa_Vinculacion']) || !empty($datosVinculacion['Fecha_Inicio_Vinculacion']) || !empty($datosVinculacion['Fecha_Finalizacion_Vinculacion']) || !empty($datosVinculacion['Horas_Vinculacion'])) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'El estudiante ya fue Aprobado.']);
            } else {
                $certificadoVinculacion->actualizarRegistro($Cedula, $data);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
            }
        } else {
            $empresa->sumarCupo($Empresa, $idAsignacion, $idCarrera);
            $certificadoVinculacion->insertarRegistro($data, $codigoCarrera);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
        }
    }

    public function enviarAprobadoPracticas()
    {
        if ($this->request->getMethod() === 'post') {
            $Cedula = $this->request->getPost('Cedula');
            $NombreCompleto = $this->request->getPost('NombreCompleto');
            $Empresa = $this->request->getPost('Empresa');
            $Fecha_fin = $this->request->getPost('Fecha_fin');
            $Fecha_Inicio = $this->request->getPost('Fecha_Inicio');
            $Horas = $this->request->getPost('Horas');
            $Carrera = $this->request->getPost('Carrera');

            $Ncarrera = new Carrera();
            $codigoCarrera = $Ncarrera->CodigoCarrera($Carrera);
            $idCarrera = $Ncarrera->idCarrera($Carrera);

            $data = [
                "cedula" => $Cedula,
                "Estudiante" => $NombreCompleto,
                "Carrera" => $Carrera,
                "Empresa_Practicas" => $Empresa,
                "Fecha_Inicio_Practicas" => $Fecha_Inicio,
                "Fecha_Finalizacion_Practicas" => $Fecha_fin,
                "Horas_Practicas" => $Horas,
            ];


            $certificado = new Certificado();
            $datosExistentes = $certificado->where('cedula', $Cedula)->first();

            $session = \Config\Services::session();
            $cargoUsuario = $session->get('cargoUsuario');
            $nombreAsignacion = $cargoUsuario;
            $asignacion = new Asignacion();
            $idAsignacion = $asignacion->buscarIdAsignacion($nombreAsignacion);
            $empresa = new Empresa();

            if ($datosExistentes) {
                if (!empty($datosExistentes['Empresa_Practicas']) || !empty($datosExistentes['Fecha_Inicio_Practicas']) || !empty($datosExistentes['Fecha_Finalizacion_Practicas']) || !empty($datosExistentes['Horas_Practicas'])) {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'El estudiante ya fue Aprobado.']);
                } else {
                    $certificado->actualizarRegistro($Cedula, $data);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
                }
            } else {
                $empresa->sumarCupo($Empresa, $idAsignacion, $idCarrera);
                $certificado->insertarRegistro($data,$codigoCarrera);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Aprobado exitosamente.']);
            }
        }
    }

    
}
