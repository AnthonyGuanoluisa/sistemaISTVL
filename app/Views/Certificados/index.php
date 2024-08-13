<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>

<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex align-items-center mb-3">
        <button type="button" class="btn rounded-pill btn-icon btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#exLargeModalInfo">
            <span class="bx bx-info-circle"></span>
        </button>
        <h4 class="fw-bold py-3 mb-4 mb-lg-0"><span class="text-muted fw-light">Administrador/ Certificados/</span>Por Generar</h4>
    </div>
    <div class="row">
        <div class="nav-align-top mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top" aria-controls="navs-top-home" aria-selected="true">
                            Certificados Carreras
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-DSW" aria-controls="navs-top-profile" aria-selected="false">
                            Certificados DSW
                        </button>
                    </li>
                </ul>
                <!--Informacion-->
                <div class="modal fade" id="exLargeModalInfo" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel4">Informacion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive text-nowrap" id="listadoDatosInfo"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Informacion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="modal-body" id="formDatosInfo" method="post">
                                <input type="hidden" name="idInformacion" id="idInformacion" value="" />
                                <div class="form-group">
                                    <div class="col mb-0">
                                        <label for="fechaCertificacion" class="form-label">Fecha Certificacion</label>
                                        <input type="text" name="fechaCertificacion" id="fechaCertificacion" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col mb-0">
                                        <label for="rector" class="form-label">Rector Institucional</label>
                                        <input type="text" name="rector" id="rector" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col mb-3">
                                        <label for="cedulaRector" class="form-label">N.cedula Rector</label>
                                        <input type="text" name="cedulaRector" id="cedulaRector" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col mb-3">
                                        <label for="encargado" class="form-label">Nobre Coodinador</label>
                                        <input type="text" name="encargado" id="encargado" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col mb-3">
                                        <label for="cedulaEncargado" class="form-label">Confirmar Contraseña</label>
                                        <input type="text" name="cedulaEncargado" id="cedulaEncargado" class="form-control" />
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
                <!--Certificados-->
                <div class="col-lg-4 col-md-6">
                    <div class="mt-3">
                        <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel4">Certificado</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="modal-body" id="formDatosGeneral" method="post" onsubmit="convertToUppercase();">
                                        <input type="hidden" name="idCertificados" id="idCertificados" value="" />
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="estudianteCertificados" class="form-label">Estudiante</label>
                                                    <input type="text" name="estudianteCertificados" id="estudianteCertificados" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="cedulaCertificados" class="form-label">Cedula</label>
                                                    <input type="text" name="cedulaCertificados" id="cedulaCertificados" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="carreraCertificados" class="form-label">Carrera</label>
                                                    <input type="text" name="carreraCertificados" id="carreraCertificados" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="empresaPracticas" class="form-label">Empresa Practicas</label>
                                                    <input type="text" name="empresaPracticas" id="empresaPracticas" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="inicioPracticas" class="form-label">Inicio</label>
                                                    <input type="date" name="inicioPracticas" id="inicioPracticas" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="finPracticas" class="form-label">Fin</label>
                                                    <input type="date" name="finPracticas" id="finPracticas" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="horasPracticas" class="form-label">Horas</label>
                                                    <input type="number" name="horasPracticas" id="horasPracticas" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="empresaVinculacion" class="form-label">Empresa Vinculacion</label>
                                                    <input type="text" name="empresaVinculacion" id="empresaVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="inicioVinculacion" class="form-label">Inicio</label>
                                                    <input type="date" name="inicioVinculacion" id="inicioVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="finVinculacion" class="form-label">Fin</label>
                                                    <input type="date" name="finVinculacion" id="finVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="horasVinculacion" class="form-label">Horas</label>
                                                    <input type="number" name="horasVinculacion" id="horasVinculacion" class="form-control" />
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
                <!--Certificado DSW-->
                <div class="col-lg-4 col-md-6">
                    <div class="mt-3">
                        <div class="modal fade" id="exLargeModalDSW" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel4">Matriz</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="modal-body" id="formDatosDSW" method="post" onsubmit="convertToUppercase();">
                                        <input type="hidden" name="idCertificado" id="idCertificado" value="" />
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="estudianteCertificado" class="form-label">Estudiante</label>
                                                    <input type="text" name="estudianteCertificado" id="estudianteCertificado" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="cedulaCertificado" class="form-label">Cedula</label>
                                                    <input type="text" name="cedulaCertificado" id="cedulaCertificado" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="carreraCertificado" class="form-label">Carrera</label>
                                                    <input type="text" name="carreraCertificado" id="carreraCertificado" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="empresaPracticasUno" class="form-label">Empresa Practicas I</label>
                                                    <input type="text" name="empresaPracticasUno" id="empresaPracticasUno" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="inicioPracticasUno" class="form-label">Inicio</label>
                                                    <input type="date" name="inicioPracticasUno" id="inicioPracticasUno" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="finPracticasUno" class="form-label">Fin</label>
                                                    <input type="date" name="finPracticasUno" id="finPracticasUno" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="horasPracticasUno" class="form-label">Horas</label>
                                                    <input type="number" name="horasPracticasUno" id="horasPracticasUno" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="empresaPracticasDos" class="form-label">Empresa Practicas II</label>
                                                    <input type="text" name="empresaPracticasDos" id="empresaPracticasDos" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="inicioPracticasDos" class="form-label">Inicio</label>
                                                    <input type="date" name="inicioPracticasDos" id="inicioPracticasDos" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="finPracticasDos" class="form-label">Fin</label>
                                                    <input type="date" name="finPracticasDos" id="finPracticasDos" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="horasPracticasDos" class="form-label">Horas</label>
                                                    <input type="number" name="horasPracticasDos" id="horasPracticasDos" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="empresaVinculacion" class="form-label">Empresa Vinculacion</label>
                                                    <input type="text" name="empresaVinculacion" id="empresaVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="inicioVinculacion" class="form-label">Inicio</label>
                                                    <input type="date" name="inicioVinculacion" id="inicioVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="finVinculacion" class="form-label">Fin</label>
                                                    <input type="date" name="finVinculacion" id="finVinculacion" class="form-control" />
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="horasVinculacion" class="form-label">Horas</label>
                                                    <input type="number" name="horasVinculacion" id="horasVinculacion" class="form-control" />
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
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top" role="tabpanel">
                    <div class="table-responsive text-nowrap" id="listadoDatos"></div>
                </div>
                <div class="tab-pane fade" id="navs-top-DSW" role="tabpanel">
                    <div class="table-responsive text-nowrap" id="listadoDatosDSW"></div>
                </div>
            </div>
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
        listarDatosInfo();
        listarDatos();
        listarDatosDSW();
    });

    //Informacion certificados
    function listarDatosInfo() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatosInfo").load("<?= base_url('/lista-informacionCertificados'); ?>", {
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

    function gestionRegistroInfo(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formDatosInfo").reset();

        switch (accion) {
            case 'editarRegistroInfo':
                $("#modalCenter").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarRegistroInfo($(aObject).data("id"));
                break;
            default:
                Swal.fire("Información!", "Opción desconocida", "info");
                break;
        }
    }

    $(document).ready(function() {

        $('#formDatosInfo').validate({
            rules: {
                rector: {
                    required: true
                },
                cedulaRector: {
                    required: true,
                },
                encargado: {
                    required: true
                },
                cedulaEncargado: {
                    required: true
                }
            },
            messages: {
                rector: {
                    required: "Parametro Obligatorio"
                },
                cedulaRector: {
                    required: "Parametro Obligatorio"
                },
                encargado: {
                    required: "Parametro Obligatorio"
                },
                cedulaEncargado: {
                    required: "Parametro Obligatorio"
                }
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {

                $.post("<?= base_url('/gestion-informacionCertificados') ?>", $("#formDatosInfo").serialize())
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
                            $("#formDatosInfo")[0].reset();
                            $("#idInformacion").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatosInfo();
                        $("#modalCenter").modal('hide');
                        $("#formDatosInfo").find('.error').removeClass("error");
                        $("#formDatosInfo").find('.success').removeClass("success");
                        $("#formDatosInfo").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarRegistroInfo(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-informacionCertificados'); ?>",
                dataType: 'json',
                data: {
                    idInformacion: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idInformacion").val(v.idInformacion);
                    $('#rector').val(v.rector);
                    $('#cedulaRector').val(v.cedulaRector);
                    $('#encargado').val(v.encargado);
                    $('#cedulaEncargado').val(v.cedulaEncargado);
                    $('#fechaCertificacion').val(v.fechaCertificacion);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }
    $('#modalCenter').on('hidden.bs.modal', function() {
        $("#formDatosInfo")[0].reset();
        $("#idInformacion").val("");
        $("#modalCenterTitle").text("Docente");
        $("#formDatosInfo").find('.error').removeClass("error");
        $("#formDatosInfo").find('.success').removeClass("success");
        $("#formDatosInfo").find('.valid').removeClass("valid");
    });

    //Certificados
    function listarDatos() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatos").load("<?= base_url('/lista-certificados'); ?>", {
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

    function gestionRegistroGeneral(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formDatosGeneral").reset();
        switch (accion) {
            case 'editarRegistroGeneral':
                $("#exLargeModal").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarRegistroGeneral($(aObject).data("id"));
                break;
            case 'eliminarRegistroGeneral':
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
                                url: "<?= base_url('/eliminar-certificados'); ?>",
                                dataType: 'json',
                                data: {
                                    idCertificados: $(aObject).data('id')
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
        $('#formDatosGeneral').validate({
            rules: {
                estudianteCertificados: {
                    required: true
                },
                cedulaCertificados: {
                    required: true,
                },
                carreraCertificados: {
                    required: true
                },
                empresaPracticas: {
                    required: true
                },
                inicioPracticas: {
                    required: true
                },
                finPracticas: {
                    required: true
                },
                horasPracticas: {
                    required: true
                },
                empresaVinculacion: {
                    required: true
                },
                inicioVinculacion: {
                    required: true
                },
                finVinculacion: {
                    required: true
                },
                horasVinculacion: {
                    required: true
                },
                horasVinculacion: {
                    required: true
                }
            },
            messages: {
                estudianteCertificado: {
                    required: "Parametro Obligatorio"
                },
                cedulaCertificado: {
                    required: "Parametro Obligatorio"
                },
                carreraCertificado: {
                    required: "Parametro Obligatorio"
                },
                empresaPracticas: {
                    required: "Parametro Obligatorio"
                },
                inicioPracticas: {
                    required: "Parametro Obligatorio"
                },
                finPracticas: {
                    required: "Parametro Obligatorio"
                },
                horasPracticas: {
                    required: "Parametro Obligatorio"
                },
                empresaVinculacion: {
                    required: "Parametro Obligatorio"
                },
                inicioVinculacion: {
                    required: "Parametro Obligatorio"
                },
                finVinculacion: {
                    required: "Parametro Obligatorio"
                },
                horasVinculacion: {
                    required: "Parametro Obligatorio"
                },
                horasVinculacion: {
                    required: "Parametro Obligatorio"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.post("<?= base_url('gestion-certificados') ?>", $("#formDatosGeneral").serialize())
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
                            }
                            $("#formDatosGeneral")[0].reset();
                            $("#idCertificados").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatos();
                        $("#formDatosGeneral").modal('hide');
                        $("#formDatosGeneral").find('.error').removeClass("error");
                        $("#formDatosGeneral").find('.success').removeClass("success");
                        $("#formDatosGeneral").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarRegistroGeneral(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-certificados'); ?>",
                dataType: 'json',
                data: {
                    idCertificados: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idCertificados").val(v.idCertificados);
                    $('#estudianteCertificados').val(v.estudianteCertificados);
                    $('#cedulaCertificados').val(v.cedulaCertificados);
                    $('#carreraCertificados').val(v.carreraCertificados);
                    $('#empresaPracticas').val(v.empresaPracticas);
                    $('#inicioPracticas').val(v.inicioPracticas);
                    $('#finPracticas').val(v.finPracticas);
                    $('#horasPracticas').val(v.horasPracticas);
                    $('#empresaVinculacion').val(v.empresaVinculacion);
                    $('#inicioVinculacion').val(v.inicioVinculacion);
                    $('#finVinculacion').val(v.finVinculacion);
                    $('#horasVinculacion').val(v.horasVinculacion);
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
        $("#formDatosGeneral")[0].reset();
        $("#idCertificados").val("");
        $("#modalCenterTitle").text("Certificado");
        $("#formDatosGeneral").find('.error').removeClass("error");
        $("#formDatosGeneral").find('.success').removeClass("success");
        $("#formDatosGeneral").find('.valid').removeClass("valid");
    });

    //Certificados DSW
    function listarDatosDSW() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatosDSW").load("<?= base_url('/lista-certificadosDSW'); ?>", {
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

    function gestionRegistroDSW(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formDatosDSW").reset();
        switch (accion) {
            case 'editarRegistroDSW':
                $("#exLargeModalDSW").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarRegistroDSW($(aObject).data("id"));
                break;
            case 'eliminarRegistroDSW':
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
                                url: "<?= base_url('/eliminar-certificadosDSW'); ?>",
                                dataType: 'json',
                                data: {
                                    idCertificado: $(aObject).data('id')
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
                                listarDatosDSW();
                            });
                    }
                });
                break;
            default:
                Swal.fire("Información!", "Opción desconocida", "error");
                break;
        }
    }

    $(document).ready(function() {
        $('#formDatosDSW').validate({
            rules: {
                estudianteCertificado: {
                    required: true
                },
                cedulaCertificado: {
                    required: true,
                },
                carreraCertificado: {
                    required: true
                },
                empresaPracticasUno: {
                    required: true
                },
                inicioPracticasUno: {
                    required: true
                },
                finPracticasUno: {
                    required: true
                },
                horasPracticasUno: {
                    required: true
                },
                empresaPracticasDos: {
                    required: true
                },
                inicioPracticasDos: {
                    required: true
                },
                finPracticasDos: {
                    required: true
                },
                horasPracticasDos: {
                    required: true
                },
                empresaVinculacion: {
                    required: true
                },
                inicioVinculacion: {
                    required: true
                },
                finVinculacion: {
                    required: true
                },
                horasVinculacion: {
                    required: true
                }
            },
            messages: {
                estudianteCertificado: {
                    required: "Parametro Obligatorio"
                },
                cedulaCertificado: {
                    required: "Parametro Obligatorio"
                },
                carreraCertificado: {
                    required: "Parametro Obligatorio"
                },
                empresaPracticasUno: {
                    required: "Parametro Obligatorio"
                },
                inicioPracticasUno: {
                    required: "Parametro Obligatorio"
                },
                finPracticasUno: {
                    required: "Parametro Obligatorio"
                },
                horasPracticasUno: {
                    required: "Parametro Obligatorio"
                },
                empresaPracticasDos: {
                    required: "Parametro Obligatorio"
                },
                inicioPracticasDos: {
                    required: "Parametro Obligatorio"
                },
                finPracticasDos: {
                    required: "Parametro Obligatorio"
                },
                horasPracticasDos: {
                    required: "Parametro Obligatorio"
                },
                empresaVinculacion: {
                    required: "Parametro Obligatorio"
                },
                inicioVinculacion: {
                    required: "Parametro Obligatorio"
                },
                finVinculacion: {
                    required: "Parametro Obligatorio"
                },
                horasVinculacion: {
                    required: "Parametro Obligatorio"
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
                $.post("<?= base_url('/gestion-certificadosDSW') ?>", $("#formDatosDSW").serialize())
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
                            }
                            $("#formDatosDSW")[0].reset();
                            $("#idCertificado").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatosDSW();
                        $("#exLargeModalDSW").modal('hide');
                        $("#formDatosDSW").find('.error').removeClass("error");
                        $("#formDatosDSW").find('.success').removeClass("success");
                        $("#formDatosDSW").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarRegistroDSW(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-certificadosDSW'); ?>",
                dataType: 'json',
                data: {
                    idCertificado: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idCertificado").val(v.idCertificado);
                    $('#estudianteCertificado').val(v.estudianteCertificado);
                    $('#cedulaCertificado').val(v.cedulaCertificado);
                    $('#carreraCertificado').val(v.carreraCertificado);
                    $('#empresaPracticasUno').val(v.empresaPracticasUno);
                    $('#inicioPracticasUno').val(v.inicioPracticasUno);
                    $('#finPracticasUno').val(v.finPracticasUno);
                    $('#horasPracticasUno').val(v.horasPracticasUno);
                    $('#empresaPracticasDos').val(v.empresaPracticasDos);
                    $('#inicioPracticasDos').val(v.inicioPracticasDos);
                    $('#finPracticasDos').val(v.finPracticasDos);
                    $('#horasPracticasDos').val(v.horasPracticasDos);
                    $('#empresaVinculacion').val(v.empresaVinculacion);
                    $('#inicioVinculacion').val(v.inicioVinculacion);
                    $('#finVinculacion').val(v.finVinculacion);
                    $('#horasVinculacion').val(v.horasVinculacion);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }
    $('#exLargeModalDSW').on('hidden.bs.modal', function() {
        $("#formDatosDSW")[0].reset();
        $("#idCertificado").val("");
        $("#modalCenterTitle").text("Certificado DSW");
        $("#formDatosDSW").find('.error').removeClass("error");
        $("#formDatosDSW").find('.success').removeClass("success");
        $("#formDatosDSW").find('.valid').removeClass("valid");
    });

    //Envio Certificados
    function gestionRegistro(aObject) {
        let accion = $(aObject).data('accion');
        let idCertificado = aObject.id.replace('certificado-', '');
        switch (accion) {
            case 'enviarCertificado':
                enviarCertificado(
                    $(aObject).data('cedula'),
                    $(aObject).data('nombrecompleto'),
                    $(aObject).data('carrera'),
                    $(aObject).data('certi'),
                    idCertificado
                );
                break;
            case 'enviarCertificadoDSW':
                enviarCertificadoDSW(
                    $(aObject).data('cedula'),
                    $(aObject).data('nombrecompleto'),
                    $(aObject).data('carrera'),
                    $(aObject).data('certi'),
                    idCertificado
                );
                break;
            default:
                Swal.fire("Información!", "Opción desconocida", "error");
                break;
        }
    }


    function enviarCertificado(cedula, nombreCompleto, carrera, certi, idCertificados) {
        $.post("<?= base_url('aprobado-certificado') ?>", {
                Cedula: cedula,
                NombreCompleto: nombreCompleto,
                Carrera: carrera,
                Certi: certi,
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
            .always(function() {
                listarDatos();
            });
    }

    function enviarCertificadoDSW(cedula, nombreCompleto, carrera, certi, idCertificados, ) {
        $.post("<?= base_url('aprobado-certificadoDSW') ?>", {
                Cedula: cedula,
                NombreCompleto: nombreCompleto,
                Carrera: carrera,
                Certi: certi,
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
            .always(function() {
                listarDatosDSW();
            });
    }
</script>

<?= $this->endSection(); ?>