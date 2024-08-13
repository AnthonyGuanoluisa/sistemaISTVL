<div class="table-responsive text-nowrap">
    <table class="table" id="tablaDSW">
        <caption class="ms-4">Lista de Certificados</caption>
        <thead>
            <tr>
                <th>N</th>
                <th>CI</th>
                <th>Estudiante</th>
                <th>Empresa Practicas I</th>
                <th>Empresa Practicas II</th>
                <th>Empresa Vinculacion</th>
                <th>Total Horas </th>
                <th>Certificado</th>
                <th>
                    <center>Acciones</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($lista) { ?>
                <?php $i = 1;
                foreach ($lista as $data) {
                    //Ver campos de practicas con datos insertados
                    $empresaPracticasLlenas = !empty($data->empresaPracticasUno);
                    $horasPracticasLlenas = !empty($data->horasPracticasUno);
                    //Ver campos de practicas DOS con datos insertados
                    $empresaPracticas2Llenas = !empty($data->empresaPracticasDos);
                    $horasPracticas2Llenas = !empty($data->horasPracticasDos);
                    //Ver campos de vinculacion con datos insertados
                    $empresaVinculacionLlenas = !empty($data->empresaVinculacion);
                    $horasVinculacionLlenas = !empty($data->horasVinculacion);
                    // metodo para completar el campo de Horas completadas
                    $horasPracticas = (float)$data->horasPracticasUno;
                    $horasPracticas2 = (float)$data->horasPracticasDos;
                    $horasVinculacion = (float)$data->horasVinculacion;
                    $horasSumadas = $horasPracticas + $horasPracticas2 + $horasVinculacion;
                ?>
                    <tr>
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?= $data->cedulaCertificado; ?></td>
                        <td><?= $data->estudianteCertificado; ?>
                        </td>
                        <td>
                            <?php if ($empresaPracticasLlenas) { ?>
                                <?= $data->empresaPracticasUno; ?>
                            <?php } else { ?>
                                <span class="badge bg-label-danger me-1">Pendiente</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($empresaPracticas2Llenas) { ?>
                                <?= $data->empresaPracticasDos; ?>
                            <?php } else { ?>
                                <span class="badge bg-label-danger me-1">Pendiente</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($empresaVinculacionLlenas) { ?>
                                <?= $data->empresaVinculacion; ?>
                            <?php } else { ?>
                                <span class="badge bg-label-danger me-1 Pendiente">Pendiente</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($horasPracticasLlenas && $horasVinculacionLlenas) { ?>
                                <?= $data->horasCompletadas = $horasSumadas; ?> Horas
                            <?php } else { ?>
                                <span class="badge bg-label-danger me-1 ">Pendiente</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($horasPracticasLlenas && $horasVinculacionLlenas) { ?>
                                <a type="button" href="javascript:void(0);" class="btn rounded-pill btn-outline-success" onclick="gestionRegistro(this);" data-accion="enviarCertificadoDSW" data-nombrecompleto="<?= $data->estudianteCertificado; ?>" data-cedula="<?= $data->cedulaCertificado; ?>" data-carrera="<?= $data->carreraCertificado; ?>" data-certi="<?= $data->numCerti; ?>" id="certificado-<?= $data->idCertificados; ?>" disabled>
                                    Certificado
                                </a>
                            <?php } else { ?>
                                <a type="button" href="javascript:void(0);" onclick="alertas(this);" data-accion="pendiente" class="badge bg-label-danger" disabled>
                                    Pendiente
                                </a>
                            <?php } ?>
                        </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistroDSW(this);" title="Editar Registro" data-accion="editarRegistroDSW" data-id="<?php echo $data->idCertificados; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistroDSW(this);" title="Eliminar Registro" data-accion="editarRegistroDSW" data-id="<?php echo $data->idCertificados; ?>">
                                    <span class="tf-icons bx bx-trash me-1"></span>
                                </button>
                            </center>
                        </td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="9" class="text-center">No hay datos</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#tablaDSW').DataTable({
                scrollX: true,
                autoWidth: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
        });

        function alertas(element) {
            let accion = element.getAttribute('data-accion');
            switch (accion) {
                case 'pendiente':
                    Swal.fire("Información!", "Falta Completar Actividades", "info");
                    break;
            }
        }
    </script>

</div>