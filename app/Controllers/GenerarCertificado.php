<?php

namespace App\Controllers;

use App\Models\Certificado;
use App\Models\CertificadoDSW;
use App\Models\InformacionCertificado;
use Dompdf\Dompdf;
use Dompdf\Options;

class GenerarCertificado extends BaseController
{
    public function generarCertificado($id)
    {
        $certificado = new Certificado();
        $data = $certificado->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Certificado no encontrado.');
        }

        $informacionCertificado = new InformacionCertificado();
        $dataInfo = $informacionCertificado->find(1);         
        if (!$dataInfo) {
            return redirect()->back()->with('error', 'Información del certificado no encontrada.');
        }

        $horasSumadas = $data['Horas_Practicas'] + $data['Horas_Vinculacion'];

        // Prepare the HTML content
        $html = view('certificado', [
            'Num_Certificado' => $data['Num_Certificado'],
            'Estudiante' => $data['Estudiante'],
            'cedula' => $data['cedula'],
            'Carrera' => $data['Carrera'],
            'Empresa_Practicas' => $data['Empresa_Practicas'],
            'Fecha_Inicio_Practicas' => $data['Fecha_Inicio_Practicas'],
            'Fecha_Finalizacion_Practicas' => $data['Fecha_Finalizacion_Practicas'],
            'Horas_Practicas' => $data['Horas_Practicas'],
            'Empresa_Vinculacion' => $data['Empresa_Vinculacion'],
            'Fecha_Inicio_Vinculacion' => $data['Fecha_Inicio_Vinculacion'],
            'Fecha_Finalizacion_Vinculacion' => $data['Fecha_Finalizacion_Vinculacion'],
            'Horas_Vinculacion' => $data['Horas_Vinculacion'],
            'Fecha' => $dataInfo['Fecha'],
            'Rector_Institucional' => $dataInfo['Rector_Institucional'],
            'Cedula_Rector' => $dataInfo['Cedula_Rector'],
            'Encargado_Certificacion' => $dataInfo['Encargado_Certificacion'],
            'Cedula_Encargado' => $dataInfo['Cedula_Encargado'],
            'horasSumadas' => $horasSumadas,
        ]);

        // Initialize Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);  // Enable loading of remote images
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF
        $fileName = 'Certificado_' . $data['cedula'] . '.pdf';
        $dompdf->stream($fileName, ['Attachment' => true]);

        return;
    }

    public function generarCertificadoDSW($id)
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

        // Prepare the HTML content
        $html = view('certificado_dsw', [
            'NumCerti' => $data['NumCerti'],
            'Estudiante' => $data['Estudiante'],
            'Cedula' => $data['Cedula'],
            'Carrera' => $data['Carrera'],
            'Empresa_1erP' => $data['Empresa_1erP'],
            'Fecha_Inicio_1erP' => $data['Fecha_Inicio_1erP'],
            'Fecha_Fin_1erP' => $data['Fecha_Fin_1erP'],
            'Horas_1erP' => $data['Horas_1erP'],
            'Empresa_2erP' => $data['Empresa_2erP'],
            'Fecha_Inicio_2erP' => $data['Fecha_Inicio_2erP'],
            'Fecha_Fin_2erP' => $data['Fecha_Fin_2erP'],
            'Horas_2erP' => $data['Horas_2erP'],
            'Empresa_Vinculacion' => $data['Empresa_Vinculacion'],
            'Fecha_Inicio_Vinculacion' => $data['Fecha_Inicio_Vinculacion'],
            'Fecha_Finalizacion_Vinculacion' => $data['Fecha_Finalizacion_Vinculacion'],
            'Horas_Vinculacion' => $data['Horas_Vinculacion'],
            'Fecha' => $dataInfo['Fecha'],
            'Rector_Institucional' => $dataInfo['Rector_Institucional'],
            'Cedula_Rector' => $dataInfo['Cedula_Rector'],
            'Encargado_Certificacion' => $dataInfo['Encargado_Certificacion'],
            'Cedula_Encargado' => $dataInfo['Cedula_Encargado'],
            'horasSumadas' => $horasSumadas,
        ]);

        // Initialize Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);  // Enable loading of remote images
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF
        $fileName = 'Certificado_' . $data['Cedula'] . '.pdf';
        $dompdf->stream($fileName, ['Attachment' => true]);

        return;
    }
}
?>
