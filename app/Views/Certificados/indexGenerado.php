<?= $this->extend('Views/Dashboard/plantillaCoordinador'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador/Certificados/</span>Por Generar </h4>
    <div class="row">
        <div class="col-xl-12">
            <h5>Certificados</h5>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Carreras" aria-controls="navs-top-home" aria-selected="true">
                            Certificados Carreras
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-DSW" aria-controls="navs-top-profile" aria-selected="false">
                            Certificados DSW
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-Carreras" role="tabpanel">
                        <p>
                        <div class="table-responsive text-nowrap" id="listadoDatos2">
                            <table class="table" id="tabla">
                                <caption class="ms-4">Lista de Certificados</caption>
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>CI</th>
                                        <th>Estudiante</th>
                                        <th>Carrera</th>
                                        <th>Certificado</th>
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
                                                <td>
                                                    <?= $data->estudianteCertificados; ?>
                                                </td>
                                                <td>
                                                    <?= $data->cedulaCertificados; ?>
                                                </td>
                                                <td>
                                                    <?= $data->carreraCertificados; ?>
                                                </td>
                                                <td>
                                                <a type="button" href="javascript:void(0);" onclick="gestionRegistro(this);" data-accion="volverCertificado" 
                                                    id="certificado-<?= $data->idCerti;?>" class="btn btn-success">
                                                        Certificado
                                                    </a>
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
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-top-DSW" role="tabpanel">
                        <p>
                        <div class="table-responsive text-nowrap" id="listadoDatos">
                            <table class="table" id="tablaDSW">
                                <caption class="ms-4">Lista de Certificados</caption>
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>CI</th>
                                        <th>Estudiante</th>
                                        <th>Carrera</th>
                                        <th>Certificado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($listaDSW) { ?>
                                        <?php $i = 1;
                                        foreach ($listaDSW as $data) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i;
                                                    $i++; ?>
                                                </td>
                                                <td>
                                                    <?= $data->estudianteCertificadosDSW; ?>
                                                </td>
                                                <td>
                                                    <?= $data->cedulaCertificadosDSW; ?>
                                                </td>
                                                <td>
                                                    <?= $data->carreraCertificadosDSW; ?>
                                                </td>
                                                <td>
                                                <a type="button" href="javascript:void(0);" onclick="gestionRegistro(this);" data-accion="volverCertificadoDSW" 
                                                id="certificado-<?= $data->idCertiDSW;?>" class="btn btn-success">
                                                    Certificado
                                                </a>
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
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>

<script>
            $(document).ready(function() {
            $('#tabla').DataTable({
                autoWidth: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
        });
        $(document).ready(function() {
            $('#tablaDSW').DataTable({
                autoWidth: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
        });
    function convertToUppercase() {
        var inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(function(input) {
            input.value = input.value.toUpperCase();
        });
    }

    function gestionRegistro(aObject) {
    let accion = $(aObject).data('accion');
    console.log("Acción obtenida:", accion); // Depuración
    let idCertificado = aObject.id.replace('certificado-', '');
    console.log("ID Certificado:", idCertificado); // Depuración

    switch (accion) {
        case 'volverCertificado':
            volverCertificado(idCertificado);
            break;
        case 'volverCertificadoDSW':
            volverCertificadoDSW(idCertificado);
            break;
        default:
            Swal.fire("Información!", "Opción desconocida", "error");
            break;
    }
}


function volverCertificado(idCertificados) {
    $.post("<?= base_url('aprobado-certificado') ?>", {
            idCertificados: idCertificados
        })
        .done(function(data) {
            let resultado = JSON.parse(data);
            if (resultado.status === 'success') {
                Swal.fire("Éxito!", resultado.message, "success").then((result) => {
                    if (result.value) {
                        window.location.href = resultado.href;
                    }
                });
            } else if (resultado.status === 'warning') {
                Swal.fire({
                    title: "Alerta!",
                    text: resultado.message,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Certificar nuevamente",
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location.href = resultado.href;
                    }
                });
            } else {
                Swal.fire("Error!", "No se pudo procesar la información", "error");
            }
        })
        .fail(function(err) {
            Swal.fire("Error!", "Error: No se pudo procesar la información", "error");
        });
}

function volverCertificadoDSW(idCertificados) {
    $.post("<?= base_url('aprobado-certificadoDSW') ?>", {
            idCertificados: idCertificados
        })
        .done(function(data) {
            let resultado = JSON.parse(data);
            if (resultado.status === 'success') {
                Swal.fire("Éxito!", resultado.message, "success").then((result) => {
                    if (result.value) {
                        window.location.href = resultado.href;
                    }
                });
            } else if (resultado.status === 'warning') {
                Swal.fire({
                    title: "Alerta!",
                    text: resultado.message,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Certificar nuevamente",
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location.href = resultado.href;
                    }
                });
            } else {
                Swal.fire("Error!", "No se pudo procesar la información", "error");
            }
        })
        .fail(function(err) {
            Swal.fire("Error!", "Error: No se pudo procesar la información", "error");
        });
}



</script>

<?= $this->endSection(); ?>