<div class="table-responsive text-nowrap">
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th>N</th>
                <th>Nombre</th>
                <th>Ruc</th>
                <th>Direccion</th>
                <th>Correo</th>
                <th>Contacto</th>
                <th>Encargado</th>
                <th>Fecha Convenio</th>
                <th>Fecha Caducidad</th>
                <th>Estado</th>
                <th>Cupos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($listaAsignacion) { ?>
                <?php $i = 1;
                $current_date = new DateTime($current_date);
                foreach ($listaAsignacion as $data) {
                    $cuposDisponibles = ($data->Cupos);
                    $fecha_caducidad = new DateTime($data->Fecha_Caducidad_Convenio);
                ?>
                    <tr>
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td>
                            <?= $data->Nombre_empresa; ?>
                        </td>
                        <td>
                            <?= $data->Ruc_Empresa; ?>
                        </td>
                        <td>
                            <?= $data->Direccion; ?>
                        </td>
                        <td>
                            <?= $data->Correo_Empresa; ?>
                        </td>
                        <td>
                            <?= $data->Telefono; ?>
                        </td>
                        <td>
                            <?= $data->Encargado; ?>
                        </td>
                        <td>
                            <?= $data->Fecha_Convenio; ?>
                        </td>
                        <td>
                            <?= $data->Fecha_Caducidad_Convenio; ?>
                        </td>
                        <td>
                            <?php if ($fecha_caducidad >= $current_date) { ?>
                                <span class="badge bg-label-success me-1 vigente">Vigente</span>
                            <?php } else { ?>
                                <span class="badge bg-label-danger me-1 caducado">Caducado</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($cuposDisponibles == 0) { ?>
                                <span class="badge bg-label-danger me-1 caducado">Sin cupos</span>
                            <?php } else { ?>
                                <?= $data->Cupos > 0 ? $data->Cupos : 'Sin cupos'; ?>
                            <?php } ?>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistro(this);" title="Editar Registro" data-accion="editarRegistro" data-id="<?php echo $data->id; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistro(this);" title="Eliminar Registro" data-accion="eliminarRegistro" data-id="<?php echo $data->id; ?>">
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