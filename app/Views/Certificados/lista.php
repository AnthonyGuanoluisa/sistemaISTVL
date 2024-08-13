<div class="table-responsive text-nowrap">
    <table class="table" id="tabla">
        <caption class="ms-4">Lista de Certificados</caption>
        <thead>
            <tr>
                <th>N</th>
                <th>CI</th>
                <th>Estudiante</th>
                <th>Carrera</th>
                <th>Empresa Practicas</th>
                <th>Empresa Vinculacion</th>
                <th>Total Horas</th>
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
                    $empresaPracticasLlenas = !empty($data->empresaPracticas);
                    $inicioPracticasLlenas = !empty($data->inicioPracticas);
                    $finPracticasLlenas = !empty($data->finPracticas);
                    $horasPracticasLlenas = !empty($data->horasPracticas);
                    //Ver campos de vinculacion con datos insertados
                    $empresaVinculacionLlenas = !empty($data->empresaVinculacion);
                    $inicioVinculacionLlenas = !empty($data->inicioVinculacion);
                    $finVinculacionLlenas = !empty($data->finVinculacion);
                    $horasVinculacionLlenas = !empty($data->horasVinculacion);
                    // metodo para completar el campo de Horas completadas
                    $horasPracticas = (float)$data->horasPracticas;
                    $horasVinculacion = (float)$data->horasVinculacion;
                    $horasSumadas = $horasPracticas + $horasVinculacion;
                    //idcertificado
                    $idCertificado = $data->idCertificados;
                ?>
                    <tr>
                        <td>
                            <?php echo $i;
                            $i++; ?>
                        </td>
                        <td><?= $data->cedulaCertificados; ?></td>
                        <td><?= $data->estudianteCertificados; ?></td>
                        <td><?= $data->carreraCertificados; ?></td>
                        <td>
                            <?php if ($empresaPracticasLlenas) { ?>
                                <?= $data->empresaPracticas; ?>
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
                                <a type="button" href="javascript:void(0);" class="btn rounded-pill btn-outline-success" onclick="gestionRegistro(this);" data-accion="enviarCertificado" data-nombrecompleto="<?= $data->estudianteCertificados; ?>" data-cedula="<?= $data->cedulaCertificados; ?>" data-carrera="<?= $data->carreraCertificados; ?>" data-certi="<?= $data->numCertificado; ?>" id="certificado-<?= $data->idCertificados; ?>" class="btn btn-success" disabled>
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
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistroGeneral(this);" title="Editar Registro" data-accion="editarRegistroGeneral" data-id="<?php echo $data->idCertificados; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-outline-primary" onclick="gestionRegistroGeneral(this);" title="Eliminar Registro" data-accion="editarRegistroGeneral" data-id="<?php echo $data->idCertificados; ?>">
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
            $('#tabla').DataTable({
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