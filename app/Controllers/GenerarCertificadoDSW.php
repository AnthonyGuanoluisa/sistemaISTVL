<?php
namespace App\Controllers;

use App\Models\CertificadoDSW;
use App\Models\InformacionCertificado;

class GenerarCertificadoDSW extends BaseController
{
    
    public function generarCertificado($id)
    {
        $certificado = new CertificadoDSW();
        $data = $certificado->find($id);
    
        if (!$data) {
            return redirect()->back()->with('error', 'Certificado no encontrado.');
        }
    
        $informacionCertificado = new InformacionCertificado();
        $dataInfo = $informacionCertificado->find(1);         
        if (!$dataInfo) {
            return redirect()->back()->with('error', 'Información del certificado no encontrada.');
        }

        $horasSumadas = $data['Horas_1erP'] + $data['Horas_2erP']  + $data['Horas_Vinculacion'];

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(WRITEPATH. 'certificates/CertificadoDSW.docx');
    
        $templateProcessor->setValue('NumCerti', $data['NumCerti']);
        $templateProcessor->setValue('Estudiante', $data['Estudiante']);
        $templateProcessor->setValue('Cedula', $data['Cedula']);
        $templateProcessor->setValue('Carrera', $data['Carrera']);
        $templateProcessor->setValue('Empresa_1erP', $data['Empresa_1erP']);
        $templateProcessor->setValue('Fecha_Inicio_1erP', $data['Fecha_Inicio_1erP']);
        $templateProcessor->setValue('Fecha_Fin_1erP', $data['Fecha_Fin_1erP']);
        $templateProcessor->setValue('Horas_1erP', $data['Horas_1erP']);
        $templateProcessor->setValue('Empresa_2erP', $data['Empresa_2erP']);
        $templateProcessor->setValue('Fecha_Inicio_2erP', $data['Fecha_Inicio_2erP']);
        $templateProcessor->setValue('Fecha_Fin_2erP', $data['Fecha_Fin_2erP']);
        $templateProcessor->setValue('Horas_2erP', $data['Horas_2erP']);
        $templateProcessor->setValue('Empresa_Vinculacion', $data['Empresa_Vinculacion']);
        $templateProcessor->setValue('Fecha_Inicio_Vinculacion', $data['Fecha_Inicio_Vinculacion']);
        $templateProcessor->setValue('Fecha_Finalizacion_Vinculacion', $data['Fecha_Finalizacion_Vinculacion']);
        $templateProcessor->setValue('Horas_Vinculacion', $data['Horas_Vinculacion']);
        $templateProcessor->setValue('Horas_Completadas', $data['Horas_Completadas']);
        $templateProcessor->setValue('Fecha', $dataInfo['Fecha']);
        $templateProcessor->setValue('Rector_Institucional', $dataInfo['Rector_Institucional']);
        $templateProcessor->setValue('Cedula_Rector', $dataInfo['Cedula_Rector']);
        $templateProcessor->setValue('Encargado_Certificacion', $dataInfo['Encargado_Certificacion']);
        $templateProcessor->setValue('Cedula_Encargado', $dataInfo['Cedula_Encargado']);
        $templateProcessor->setValue('horasSumadas', $horasSumadas);

        $fileName = 'Certificado_'. $data['Cedula']. '.docx';
        $tempFilePath = WRITEPATH. 'uploads/'. $fileName;
    
        $templateProcessor->saveAs($tempFilePath);
    
        return $this->response->download($tempFilePath, null)->setFileName($fileName);
    }

}
?>
