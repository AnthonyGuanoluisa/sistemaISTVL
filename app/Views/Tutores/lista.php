<div class="table-responsive text-nowrap">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th>N</th>
                <th>CI</th>
                <th>Docentes</th>
                <th>Correo</th>
                <th>Carrera</th>
                <th>Jornada</th>
                <th>Vigente</th>
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
                        <td><?= $data->cedulaTutor; ?></td>
                        <td><?= $data->Nombres . ' ' . $data->Apellidos; ?></td>
                        <td><?= $data->Correo; ?></td>
                        <td><?= $data->Nombre_Carrera; ?></td>
                        <td><?= $data->Tipo_Jornada; ?></td>
                        <td>
                            <?php if ($data->Vigente == "SI") { ?>
                                <spam type="text" class="badge bg-label-success">SI</spam>
                            <?php } else { ?>
                                <spam type="text" class="badge bg-label-danger">NO</spam>
                            <?php } ?>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistro(this);" title="Editar Registro" data-accion="editarRegistro" data-id="<?php echo $data->cedulaTutor; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistro(this);" title="Eliminar Registro" data-accion="eliminarRegistro" data-id="<?php echo $data->cedulaTutor; ?>">
                                    <span class="tf-icons bx bx-trash me-1"></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="text-center">No hay datos</td>
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
            buttons: [{
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