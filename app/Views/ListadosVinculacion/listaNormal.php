<div class="table-responsive text-nowrap">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th>N</th>
                <th>CI</th>
                <th>Estudiantes</th>
                <th>Empresa</th>
                <th>Nombre De Proyecto</th>
                <th>Periodo</th>
                <th>Horas</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
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
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?= $data->Cedula; ?></td>
                        <td><?= $data->NombreCompleto; ?></td>
                        <td><?= $data->Nombre_empresa; ?></td>
                        <td><?= $data->Nombre_Proyecto; ?></td>
                        <td><?= $data->Periodo; ?></td>
                        <td><?= $data->Horas; ?></td>
                        <td><?= $data->Fecha_Inicio; ?></td>
                        <td><?= $data->Fecha_Fin; ?></td>
                        <td>
                            <?php if ($data->Aprobado == "SI") { ?>
                                <a type="button" class="badge bg-label-success" href="javascript:void(0);" onclick="gestionRegistro(this);" data-accion="enviarAprobado" data-nombrecompleto="<?= $data->NombreCompleto; ?>" data-cedula="<?= $data->Cedula; ?>" data-carrera="<?= $data->Nombre_Carrera; ?>" data-empresa="<?= $data->Nombre_empresa; ?>" data-fecha_inicio="<?= $data->Fecha_Inicio; ?>" data-fecha_fin="<?= $data->Fecha_Fin; ?>" data-horas="<?= $data->Horas; ?>" class="btn btn-success" disabled>
                                    Aprobado
                                </a>
                            <?php } else { ?>
                                <a type="button" class="badge bg-label-warning" href="javascript:void(0);" onclick="gestionRegistro(this);" data-accion="pendiente" class="btn btn-warning" disabled>Pendiente</a>
                            <?php } ?>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistro(this);" title="Editar Registro" data-accion="editarRegistro" data-id="<?php echo $data->idVinculacion; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistro(this);" title="Eliminar Registro" data-accion="eliminarRegistro" data-id="<?php echo $data->idVinculacion; ?>">
                                    <span class="tf-icons bx bx-trash me-1"></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="11" class="text-center">No hay datos</td>
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