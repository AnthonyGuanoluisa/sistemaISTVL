<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>

<!-- Content -->
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador /</span> Cursos</h4>
    <div class="row">
        <div class="col-xl-0">
            <!--Cursos-->
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="modalcenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Cursos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idCurso" id="idCurso" value="" />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="nombreCurso" class="form-label">Nombre Curso</label>
                                                <input type="text" name="nombreCurso" id="nombreCurso" class="form-control" />
                                            </div>
                                            <div class="col mb-2">
                                                <label for="nivelCurso" class="form-label">Nivel</label>
                                                <select name="nivelCurso" id="nivelCurso" class="form-select">
                                                    <?php if ($niveles) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($niveles as $dp) { ?>
                                                            <option value="<?= $dp->idNivel; ?>"><?= $dp->nombreNivel; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="cicloCurso" class="form-label">Ciclo Academico</label>
                                                <select name="cicloCurso" id="cicloCurso" class="form-select">
                                                    <?php if ($periodos) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($periodos as $dp) { ?>
                                                            <option value="<?= $dp->idPeriodos; ?>"><?= $dp->tipoCiclo; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-2">
                                                <label for="jornadaCurso" class="form-label">Jornada</label>
                                                <select name="jornadaCurso" id="jornadaCurso" class="form-select">
                                                    <?php if ($jornadas) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($jornadas as $dp) { ?>
                                                            <option value="<?= $dp->idJornada; ?>"><?= $dp->tipoJornada; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="carreraCurso" class="form-label">Carrera</label>
                                        <select name="carreraCurso" id="carreraCurso" class="form-select">
                                            <?php if ($carreras) { ?>
                                                <option value="">SELECCIONE...</option>
                                                <?php foreach ($carreras as $dp) { ?>
                                                    <?php if (strtolower($dp->NombreCarrera) != 'COORDINACION') { ?>
                                                        <option value="<?= $dp->idCarrera; ?>"><?= $dp->NombreCarrera; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
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
            <!--Ciclo-->
            <div class="modal fade" id="smallModalCiclo" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Ciclo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" id="formCiclo" method="post" onsubmit="convertToUppercase();">
                            <input type="hidden" name="idPeriodos" id="idPeriodos" value="" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="tipoJornada" class="form-label">Ciclo</label>
                                        <input type="text" name="tipoCiclo" id="tipoCiclo" class="form-control" />
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
            <!--Jornada-->
            <div class="modal fade" id="smallModalJornada" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Jornada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" id="formJornada" method="post" onsubmit="convertToUppercase();">
                            <input type="hidden" name="idJornada" id="idJornada" value="" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="tipoJornada" class="form-label">Jornada</label>
                                        <input type="text" name="tipoJornada" id="tipoJornada" class="form-control" />
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
            <!--Nivel-->
            <div class="modal fade" id="smallModalNivel" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Nivel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body" id="formNivel" method="post" onsubmit="convertToUppercase();">
                            <input type="hidden" name="idNivel" id="idNivel" value="" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="nombreNivel" class="form-label">Nivel</label>
                                        <input type="text" name="nombreNivel" id="nombreNivel" class="form-control" />
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
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-curso" aria-controls="navs-justified-curso" aria-selected="true">
                            Cursos
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-ciclo" aria-controls="navs-justified-ciclo" aria-selected="false">
                            Ciclo
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-Jornada" aria-controls="navs-justified-Jornada" aria-selected="false">
                            Jornada
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-nivel" aria-controls="navs-justified-nivel" aria-selected="false">
                            Nivel
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-justified-curso" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalcenter">
                                <i class="tf-icons bx bx-plus"></i> Agregar
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap" id="listadoDatos"></div>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-ciclo" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#smallModalCiclo">
                                <i class="tf-icons bx bx-plus"></i> Agregar
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap" id="listadoCiclo"></div>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-Jornada" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#smallModalJornada">
                                <i class="tf-icons bx bx-plus"></i> Agregar
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap" id="listadoJornada"></div>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-nivel" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#smallModalNivel">
                                <i class="tf-icons bx bx-plus"></i> Agregar
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap" id="listadoNiveles"></div>
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
    function convertToUppercase() {
        var inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(function(input) {
            input.value = input.value.toUpperCase();
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        listarDatos();
        listarNivel();
        listarJornada();
        listarCiclo();
    });
    //Cursos
    function listarDatos() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatos").load("<?= base_url('/listado-cursos'); ?>", {
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
                $("#idCurso").val("");
                $("#modalcenter").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#modalcenter").modal('show');
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
                                url: "<?= base_url('/eliminar-cursos'); ?>",
                                dataType: 'json',
                                data: {
                                    idCurso: $(aObject).data('id')
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
                                Swal.fire("Información!", "El curso esta siendo utilizado", "info");
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
                nombreCurso: {
                    required: true
                },
                nivelCurso: {
                    required: true
                },
                cicloCurso: {
                    required: true
                },
                jornadaCurso: {
                    required: true
                }
            },
            messages: {
                nombreCurso: {
                    required: "Agregar Curso Obligatorio"
                },
                nivelCurso: {
                    required: "Agregar Nivel Obligatorio",
                },
                cicloCurso: {
                    required: "Ciclo Academico obligatorio"
                },
                jornadaCurso: {
                    required: "Jornada obligatoria"
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
                $.post("<?= base_url('/gestion-cursos') ?>", $("#formDatos").serialize())
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
                            $("#formDatos")[0].reset();
                            $("#idCurso").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatos();
                        $("#modalcenter").modal('hide');
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
                url: "<?= base_url('/buscar-cursos'); ?>",
                dataType: 'json',
                data: {
                    idCurso: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idCurso").val(v.idCurso);
                    $('#nombreCurso').val(v.nombreCurso);
                    $('#nivelCurso').val(v.nivelCurso);
                    $('#cicloCurso').val(v.cicloCurso);
                    $('#jornadaCurso').val(v.jornadaCurso);
                    $('#carreraCurso').val(v.carreraCurso);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }

    $('#modalcenter').on('hidden.bs.modal', function() {
        $("#formDatos")[0].reset();
        $("#idCurso").val("");
        $("#modalCenterTitle").text("Curso");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });

    //Ciclos
    function listarCiclo() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoCiclo").load("<?= base_url('/listado-periodos'); ?>", {
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

    function gestionPeriodo(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formCiclo").reset();

        switch (accion) {
            case 'insertarRegistro':
                $("#idPeriodos").val("");
                $("#smallModalCiclo").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#smallModalCiclo").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarPeriodo($(aObject).data("id"));
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
                                url: "<?= base_url('/eliminar-periodos'); ?>",
                                dataType: 'json',
                                data: {
                                    idPeriodos: $(aObject).data('id')
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
                                listarCiclo();
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
        $('#formCiclo').validate({
            rules: {
                tipoCiclo: {
                    required: true
                }
            },
            messages: {
                tipoCiclo: {
                    required: "Campo Obligatorio"
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
                $.post("<?= base_url('/gestion-periodos') ?>", $("#formCiclo").serialize())
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
                            $("#formCiclo")[0].reset();
                            $("#idPeriodos").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarCiclo();
                        $("#smallModalCiclo").modal('hide');
                        $("#formCiclo").find('.error').removeClass("error");
                        $("#formCiclo").find('.success').removeClass("success");
                        $("#formCiclo").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarPeriodo(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-periodos'); ?>",
                dataType: 'json',
                data: {
                    idPeriodos: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idPeriodos").val(v.idPeriodos);
                    $('#tipoCiclo').val(v.tipoCiclo);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }

    $('#smallModalCiclo').on('hidden.bs.modal', function() {
        $("#formCiclo")[0].reset();
        $("#idPeriodos").val("");
        $("#modalCenterTitle").text("Periodo");
        $("#formCiclo").find('.error').removeClass("error");
        $("#formCiclo").find('.success').removeClass("success");
        $("#formCiclo").find('.valid').removeClass("valid");
    });

    //Jornadas
    function listarJornada() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoJornada").load("<?= base_url('/listado-jornadas'); ?>", {
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

    function gestionJornada(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formJornada").reset();

        switch (accion) {
            case 'insertarRegistro':
                $("#idJornada").val("");
                $("#smallModalJornada").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#smallModalJornada").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarJornada($(aObject).data("id"));
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
                                url: "<?= base_url('/eliminar-jornadas'); ?>",
                                dataType: 'json',
                                data: {
                                    idJornada: $(aObject).data('id')
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
                                listarJornada();
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
        $('#formJornada').validate({
            rules: {
                tipoJornada: {
                    required: true
                }
            },
            messages: {
                tipoJornada: {
                    required: "Campo Obligatorio"
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
                $.post("<?= base_url('/gestion-jornadas') ?>", $("#formJornada").serialize())
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
                            $("#formJornada")[0].reset();
                            $("#idJornada").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarJornada();
                        $("#smallModalJornada").modal('hide');
                        $("#formJornada").find('.error').removeClass("error");
                        $("#formJornada").find('.success').removeClass("success");
                        $("#formJornada").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarJornada(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-jornadas'); ?>",
                dataType: 'json',
                data: {
                    idJornada: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idJornada").val(v.idJornada);
                    $('#tipoJornada').val(v.tipoJornada);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }

    $('#smallModalJornada').on('hidden.bs.modal', function() {
        $("#formJornada")[0].reset();
        $("#idJornada").val("");
        $("#modalCenterTitle").text("Jornada");
        $("#formJornada").find('.error').removeClass("error");
        $("#formJornada").find('.success').removeClass("success");
        $("#formJornada").find('.valid').removeClass("valid");
    });

    //Niveles
    function listarNivel() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoNiveles").load("<?= base_url('/listado-niveles'); ?>", {
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

    function gestionNivel(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formNivel").reset();

        switch (accion) {
            case 'insertarRegistro':
                $("#idNivel").val("");
                $("#smallModalNivel").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#smallModalNivel").modal('show');
                $("#modalCenterTitle").text("Editar Registro");
                editarNivel($(aObject).data("id"));
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
                                url: "<?= base_url('/eliminar-niveles'); ?>",
                                dataType: 'json',
                                data: {
                                    idNivel: $(aObject).data('id')
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
                                listarNivel();
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
        $('#formNivel').validate({
            rules: {
                nombreNivel: {
                    required: true
                }
            },
            messages: {
                nombreNivel: {
                    required: "Campo Obligatorio"
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
                $.post("<?= base_url('/gestion-niveles') ?>", $("#formNivel").serialize())
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
                            $("#formNivel")[0].reset();
                            $("#idNivel").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarNivel();
                        $("#smallModalNivel").modal('hide');
                        $("#formNivel").find('.error').removeClass("error");
                        $("#formNivel").find('.success').removeClass("success");
                        $("#formNivel").find('.valid').removeClass("valid");
                    });
            }
        });
    });

    function editarNivel(id) {
        showSpinner();
        $.ajax({
                type: 'post',
                url: "<?= base_url('/buscar-niveles'); ?>",
                dataType: 'json',
                data: {
                    idNivel: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idNivel").val(v.idNivel);
                    $('#nombreNivel').val(v.nombreNivel);
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
            })
            .always(function() {
                hideSpinner();
            });
    }

    $('#smallModalNivel').on('hidden.bs.modal', function() {
        $("#formNivel")[0].reset();
        $("#idNivel").val("");
        $("#modalCenterTitle").text("Nivel");
        $("#formNivel").find('.error').removeClass("error");
        $("#formNivel").find('.success').removeClass("success");
        $("#formNivel").find('.valid').removeClass("valid");
    });
</script>
<!-- / Content -->
<?= $this->endSection(); ?>