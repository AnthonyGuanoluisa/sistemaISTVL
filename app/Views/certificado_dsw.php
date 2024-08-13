<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado</title>
    <style>
        .background-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        body {
            font-size: 11;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-style: oblique;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .container {
            padding: 1.50cm;
        }

        table {
            width: 104%;
            border-collapse: collapse;
            margin-bottom: 2em;
            font-size: 10;
        }

        table th,
        table td {
            padding: 3px;
            border: 1px solid black;
            text-align: center;
        }

        .signature {
            font-size: 10;
        }

        .signature div {
            display: inline-block;
            vertical-align: top;
            margin-right: 10%;
        }
    </style>
</head>

<body back>
    <img src="<?= base_url('assets/img/favicon/plantilla.jpg'); ?>" class="background-img">
    <p align="right">CERTIFICADO No. <?= $NumCerti ?></p>
    <div class="container">
        <h2 align="center">RECTOR DEL INSTITUTO SUPERIOR TECNOLÓGICO “VICENTE LEÓN”</h2>
        <p align="left">Conforme lo establece el Reglamento de Prácticas Preprofesionales en su artículo 33 y en base al seguimiento y verificación de documentos que reposan como evidencia en Coordinación de Carrera y en la Coordinación de Vinculación con la Sociedad.</p>
        <h2 align="center">CERTIFICA</h2>
        <p>Que el/la Estudiante:</p>
        <p><strong>Nombres Completos: <?= $Estudiante ?></strong></p>
        <p><strong>Cédula de ciudadanía: <?= $Cedula ?></strong></p>
        <p><strong>Carrera: <?= $Carrera ?></strong></p>
        <p><strong>Cumplió con:</strong></p>
        <table>
            <thead>
                <tr>
                    <th width="30%">PROCESO</th>
                    <th width="20%">FECHA DE INICIO (mm/dd/aa)</th>
                    <th width="25%">FECHA DE FINALIZACIÓN (mm/dd/aa)</th>
                    <th width="20%">NÚMERO DE HORAS</th>
                    <th width="50%">INSTITUCIÓN/EMPRESA /COMUNIDAD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prácticas Pre Profesionales I</td>
                    <td><?= $Fecha_Inicio_1erP ?></td>
                    <td><?= $Fecha_Fin_1erP ?></td>
                    <td><?= $Horas_1erP ?></td>
                    <td><?= $Empresa_1erP ?></td>
                </tr>
                <tr>
                    <td>Prácticas Pre Profesionales II</td>
                    <td><?= $Fecha_Inicio_2erP ?></td>
                    <td><?= $Fecha_Fin_2erP ?></td>
                    <td><?= $Horas_2erP ?></td>
                    <td><?= $Empresa_2erP ?></td>
                </tr>
                <tr>
                    <td>Vinculación con la sociedad</td>
                    <td><?= $Fecha_Inicio_Vinculacion ?></td>
                    <td><?= $Fecha_Finalizacion_Vinculacion ?></td>
                    <td><?= $Horas_Vinculacion ?></td>
                    <td><?= $Empresa_Vinculacion ?></td>
                </tr>
                <tr>
                    <td style="border: inset 0pt"></td>
                    <td colspan="2"><strong>TOTAL HORAS:</strong></th>
                    <td><?= $horasSumadas ?></td>
                    <td style="border: inset 0pt"></td>
                </tr>
            </tbody>
        </table>
        <p align="left"><strong>TOTAL HORAS: <?= $horasSumadas ?></strong></p>
        <p align="right">Latacunga, <?= $Fecha ?></p>
        <br>
        <br>
        <div class="signature">
            <div>
                <p align="left">___________________________________</p>
                <strong>
                    <p align="left">Ing. <?= $Rector_Institucional ?><br>CI: <?= $Cedula_Rector ?><br>RECTOR DEL INSTITUTO SUPERIOR<br> TECNOLÓGICO "VICENTE LEÓN"</p>
                </strong>
            </div>
            <div>
                <p align="left">___________________________________</p>
                <strong>
                    <p align="left">Abg. <?= $Encargado_Certificacion ?><br>CI: <?= $Cedula_Encargado ?><br>COORDINADOR VINCULACIÓN</p>
                </strong>
            </div>
        </div>
    </div>
</body>

</html>