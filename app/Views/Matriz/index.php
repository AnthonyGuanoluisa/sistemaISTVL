<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador/</span>Matriz</h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel4">Matriz</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idMatriz" id="idMatriz" value="" />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="zonaMatriz" class="form-label">Zona</label>
                                                <input type="number" name="zonaMatriz" id="zonaMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="provinciaMatriz" class="form-label">Provincia</label>
                                                <input type="text" name="provinciaMatriz" id="provinciaMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="institutoMatriz" class="form-label">Instituto</label>
                                                <input type="text" name="institutoMatriz" id="institutoMatriz" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="empresaMatriz" class="form-label">Nombre/Empresa Receptora</label>
                                                <input type="text" name="empresaMatriz" id="empresaMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="representanteMatriz" class="form-label">Representante legal de la Empresa </label>
                                                <input type="text" name="representanteMatriz" id="representanteMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="convenioMatriz" class="form-label">Convenio</label>
                                                <input type="text" name="convenioMatriz" id="convenioMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="carreraMatriz" class="form-label">Carrera</label>
                                                <input type="text" name="carreraMatriz" id="carreraMatriz" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="correoMatriz" class="form-label">E-mail de la Empresa</label>
                                                <input type="email" name="correoMatriz" id="correoMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="telefonoMatriz" class="form-label">Contacto de la Empresa</label>
                                                <input type="text" name="telefonoMatriz" id="telefonoMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="direccionMatriz" class="form-label">Dirección de la Empresa</label>
                                                <input type="text" name="direccionMatriz" id="direccionMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="sectorProductivo" class="form-label">Sector Productivo</label>
                                                <input type="text" name="sectorProductivo" id="sectorProductivo" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="aprovacionMatriz" class="form-label">N°.Documento/Aprobación del ITV por: OCS-SENESCYT</label>
                                                <input type="text" name="aprovacionMatriz" id="aprovacionMatriz" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="fechaSuscripcionMatriz" class="form-label">FECHA DE SUSCRIPCIÓN</label>
                                                <input type="date" name="fechaSuscripcionMatriz" id="fechaSuscripcionMatriz" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="fechaTerminacionMatriz" class="form-label">FECHA DE TERMINACIÓN</label>
                                                <input type="date" name="fechaTerminacionMatriz" id="fechaTerminacionMatriz" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="beneficiariosCarrera" class="form-label">PROYECCIÓN DE ESTUDIANTES BENEFICIARIOS DEL CONVENIO EN LA CARRERA</label>
                                                <input type="number" name="beneficiariosCarrera" id="beneficiariosCarrera" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="beneficiariosConvenio" class="form-label">No.ESTUDIANTES BENEFICIARIOS DEL CONVENIO</label>
                                                <input type="number" name="beneficiariosConvenio" id="beneficiariosConvenio" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="naturalezaEmpresa" class="form-label">NATURALEZA DE LA EMPRESA ( NATURAL -JURÍDICA)</label>
                                                <input type="text" name="naturalezaEmpresa" id="naturalezaEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="tipoEmpresaMatriz" class="form-label">TIPO DE EMPRESA (PÚBLICA -PRIVADA)</label>
                                                <input type="text" name="tipoEmpresaMatriz" id="tipoEmpresaMatriz" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" id="botonGuardar" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap" id="listadoDatos"></div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
<script>
    function convertToUppercase() {
        var inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(function(input) {
            input.value = input.value.toUpperCase();
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        listarDatos();
    });

    function listarDatos() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatos").load("<?= base_url('/lista-matriz'); ?>", {
            urlCode
        }, function(responseText, statusText, xhr) {
            if (statusText == "success") {
                hideSpinner();
            }
            if (statusText == "error") {
                Swal.fire("Error!", "No se pudo cargar el listado", "error");
                hideSpinner();
            }
        });
    }

    function gestionRegistro(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formDatos").reset();
        switch (accion) {
            case 'insertarRegistro':
                $("#idMatriz").val("");
                $("#exLargeModal").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#exLargeModal").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarRegistro($(aObject).data("id"));
                break;
            case 'eliminarRegistro':
                Swal.fire({
                    title: 'Eliminar?',
                    text: "Se borrará el registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                type: 'post',
                                url: "<?= base_url('/eliminar-matriz'); ?>",
                                dataType: 'json',
                                data: {
                                    idMatriz: $(aObject).data('id')
                                }
                            })
                            .done(function(data) {
                                if (data) {
                                    Swal.fire("Eliminado!", "Registro eliminado", "success");
                                } else {
                                    Swal.fire("Error!", "No se pudo eliminar", "error");
                                }
                            })
                            .fail(function() {
                                Swal.fire("Error!", "Error: No se pudo eliminar", "error");
                            })
                            .always(function() {
                                listarDatos();
                            });
                    }
                });
                break;
            default:
                Swal.fire("Información!", "Opción desconocida", "info");
                break;
        }
    }

    $(document).ready(function() {
        $('#formDatos').validate({
            rules: {
                zonaMatriz: {
                    required: true
                },
                provinciaMatriz: {
                    required: true
                },
                institutoMatriz: {
                    required: true
                },
                convenioMatriz: {
                    required: true
                },
                carreraMatriz: {
                    required: true
                },
                beneficiariosCarrera: {
                    required: true
                },
                beneficiariosConvenio: {
                    required: true
                },
                aprovacionMatriz: {
                    required: true
                },
                empresaMatriz: {
                    required: true
                },
                naturalezaEmpresa: {
                    required: true
                },
                tipoEmpresaMatriz: {
                    required: true
                },
                representanteMatriz: {
                    required: true
                },
                direccionMatriz: {
                    required: true
                },
                correoMatriz: {
                    required: true
                },
                telefonoMatriz: {
                    required: true
                },
                sectorProductivo: {
                    required: true
                },
                fechaSuscripcionMatriz: {
                    required: true
                },
                fechaTerminacionMatriz: {
                    required: true
                }
            },
            messages: {
                zonaMatriz: {
                    required: "Parametro obligatorio"
                },
                provinciaMatriz: {
                    required: "Parametro obligatorio"
                },
                institutoMatriz: {
                    required: "Parametro obligatorio"
                },
                convenioMatriz: {
                    required: "Parametro obligatorio"
                },
                carreraMatriz: {
                    required: "Parametro obligatorio"
                },
                beneficiariosCarrera: {
                    required: "Parametro obligatorio"
                },
                beneficiariosConvenio: {
                    required: "Parametro obligatorio"
                },
                aprovacionMatriz: {
                    required: "Parametro obligatorio"
                },
                empresaMatriz: {
                    required: "Parametro obligatorio"
                },
                naturalezaEmpresa: {
                    required: "Parametro obligatorio"
                },
                tipoEmpresaMatriz: {
                    required: "Parametro obligatorio"
                },
                representanteMatriz: {
                    required: "Parametro obligatorio"
                },
                direccionMatriz: {
                    required: "Parametro obligatorio"
                },
                correoMatriz: {
                    required: "Parametro obligatorio"
                },
                telefonoMatriz: {
                    required: "Parametro obligatorio"
                },
                sectorProductivo: {
                    required: "Parametro obligatorio"
                },
                fechaSuscripcionMatriz: {
                    required: "Parametro obligatorio"
                },
                fechaTerminacionMatriz: {
                    required: "Parametro obligatorio"
                }
            },
            errorPlacement: function(error, element) {
                var container = $(element).data('error-container');
                if (container) {
                    $(container).append(error);
                } else {
                    element.parent().append(error);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.post("<?= base_url('/gestion-matriz') ?>", $("#formDatos").serialize())
                    .done(function(data) {
                        if (data) {
                            data = data.replace('"', '');
                            var row = data.split('|');
                            switch (row[0]) {
                                case 'i':
                                    Swal.fire("Éxito!", "Registro insertado", "success");
                                    break;
                                case 'e':
                                    Swal.fire("Éxito!", "Registro editado", "success");
                                    break;
                                case 'd':
                                    Swal.fire("Error!", "El Usuario Ya se encuentra Registrado", "error");
                                    break;
                            }
                            $("#formDatos")[0].reset();
                            $("#idMatriz").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatos();
                        $("#exLargeModal").modal('hide');
                        $("#formDatos").find('.error').removeClass("error");
                        $("#formDatos").find('.success').removeClass("success");
                        $("#formDatos").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarRegistro(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-matriz'); ?>",
                dataType: 'json',
                data: {
                    idMatriz: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idMatriz").val(v.idMatriz);
                    $('#zonaMatriz').val(v.zonaMatriz);
                    $('#provinciaMatriz').val(v.provinciaMatriz);
                    $('#institutoMatriz').val(v.institutoMatriz);
                    $('#convenioMatriz').val(v.convenioMatriz);
                    $('#carreraMatriz').val(v.carreraMatriz);
                    $('#beneficiariosCarrera').val(v.beneficiariosCarrera);
                    $('#beneficiariosConvenio').val(v.beneficiariosConvenio);
                    $('#aprovacionMatriz').val(v.aprovacionMatriz);
                    $('#empresaMatriz').val(v.empresaMatriz);
                    $('#naturalezaEmpresa').val(v.naturalezaEmpresa);
                    $('#tipoEmpresaMatriz').val(v.tipoEmpresaMatriz);
                    $('#representanteMatriz').val(v.representanteMatriz);
                    $('#direccionMatriz').val(v.direccionMatriz);
                    $('#correoMatriz').val(v.correoMatriz);
                    $('#telefonoMatriz').val(v.telefonoMatriz);
                    $('#sectorProductivo').val(v.sectorProductivo);
                    $('#fechaSuscripcionMatriz').val(v.fechaSuscripcionMatriz);
                    $('#fechaTerminacionMatriz').val(v.fechaTerminacionMatriz);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }
    $('#exLargeModal').on('hidden.bs.modal', function() {
        $("#formDatos")[0].reset();
        $("#idMatriz").val("");
        $("#exampleModalLabel4").text("Matriz");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });
</script>
<?= $this->endSection(); ?>