<div class="table-responsive text-nowrap">
    <table class="table" id="tabla">
        <caption class="ms-4">Lista Matriz</caption>
        <thead>
            <tr>
                <th>N</th>
                <th>Zona</th>
                <th>Provincia</th>
                <th>Instituto</th>
                <th>Convenio</th>
                <th>Carrera</th>
                <th>Proyección de estudiantes<br>beneficiarios del convenio<br>en la carrera</th>
                <th>N°.estudiantes<br>beneficiarios<br>del convenio</th>
                <th>N°.de Documento<br>/Aprobación del ITV<br>por:OCS-SENESCYT</th>
                <th>Nombre/empresa receptora</th>
                <th>naturaleza de la empresa<br>(Natural-Júridica)</th>
                <th>Tipo de empresa<br>(Pública-Privada)</th>
                <th>Dirección de la empresa</th>
                <th>Nombre del representante<br>legal de la empresa </th>
                <th>teléfono convencional<br>Y/O celular empresa</th>
                <th>E-mail de la Empresa</th>
                <th>Sector Productivo</th>
                <th>Fecha de suscripción</th>
                <th>Fecha de terminación</th>
                <th>
                    <center>Acciones</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($lista) { ?>
                <?php $i = 1;
                foreach ($lista as $data) { ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?= $data->zona; ?></td>
                        <td><?= $data->Provincia; ?></td>
                        <td><?= $data->Instituto; ?></td>
                        <td><?= $data->Convenio; ?></td>
                        <td><?= $data->Carrera; ?></td>
                        <td><?= $data->Beneficiarios_carrera; ?></td>
                        <td><?= $data->Beneficiarios_convenio; ?></td>
                        <td><?= $data->Aprovacion; ?></td>
                        <td><?= $data->Empresa; ?></td>
                        <td><?= $data->Naturaleza_empresa; ?></td>
                        <td><?= $data->Tipo_empresa; ?></td>
                        <td><?= $data->Direccion_empresa; ?></td>
                        <td><?= $data->Representante_empresa; ?></td>
                        <td><?= $data->Telefono_empresa; ?></td>
                        <td><?= $data->Correo_empresa; ?></td>
                        <td><?= $data->Sector_Productivo; ?></td>
                        <td><?= $data->Fecha_suscripcion; ?></td>
                        <td><?= $data->Fecha_terminacion; ?></td>
                        <td>
                        <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary "  onclick="gestionRegistro(this);" title="Editar Registro" data-accion="editarRegistro" data-id="<?php echo $data->id; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistro(this);" title="Eliminar Registro" data-accion="eliminarRegistro" data-id="<?php echo $data->id; ?>">
                                    <span class="tf-icons bx bx-trash me-1" ></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="20" class="text-center">No hay datos</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            dom: "<'row'<'col-sm-5'B><'col-sm-3'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="bx bxs-copy-alt"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'Copiar'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="bx bxs-file"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="bx bxs-file-pdf"></i>',
                    className: 'btn btn-outline-secondary',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="bx bx-printer" ></i>',
                    className: 'btn btn-outline-primary',
                    titleAttr: 'Imprimir',
                    autoPrint: false
                }
            ],
            scrollX: true,
            autoWidth: false,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            }
        });
    });
</script>