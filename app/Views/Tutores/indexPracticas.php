<?= $this->extend('Views/Dashboard/plantillaPracticas'); ?>
<?= $this->section('contenido'); ?>
<!-- Content -->
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4">
            <span id="displayComment" class="text-muted fw-light">Practicas/</span>Tutores
        </h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Tutor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="cedulaTutor" class="form-label">Cedula</label>
                                                <input type="text" name="cedulaTutor" id="cedulaTutor" class="form-control" pattern="\d{10}" title="Debe contener 10 dígitos" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-2">
                                            <label for="nombreTutor" class="form-label">Nombres</label>
                                            <input type="text" name="nombreTutor" id="nombreTutor" class="form-control" />
                                        </div>
                                        <div class="col mb-2">
                                            <label for="apellidoTutor" class="form-label">Apellidos</label>
                                            <input type="text" name="apellidoTutor" id="apellidoTutor" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="telefonoTutor" class="form-label">Telefono</label>
                                            <input type="text" name="telefonoTutor" id="telefonoTutor" class="form-control" />
                                        </div>
                                        <div class="col mb-2">
                                            <label for="correoTutor" class="form-label">Correo</label>
                                            <input type="email" name="correoTutor" id="correoTutor" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="jornadaTutor" class="form-label">Jornada</label>
                                                <select name="jornadaTutor" id="jornadaTutor" class="form-select">
                                                    <?php if ($jornada) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($jornada as $dp) { ?>
                                                            <option value="<?= $dp->idJornada; ?>"><?= $dp->tipoJornada; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="carreraTutor" class="form-label">Carrera</label>
                                            <select name="carreraTutor" id="carreraTutor" class="form-select">
                                                <option value="<?= $carreraUsuario; ?>"><?= $nombreCarreraUsuario; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col mb-2">
                                        <label for="vigencia" class="form-label">Vigente</label>
                                        <select name="vigencia" id="vigencia" class="form-select">
                                            <option selected>SELECCIONE..</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
        $("#listadoDatos").load("<?= base_url('/lista-tutor'); ?>", {
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
                $("#cedulaTutor").val("");
                $("#modalCenter").modal('show');
                $("#modalCenterTitle").text("Nuevo Registro");
                break;
            case 'editarRegistro':
                $("#modalCenter").modal('show');
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
                                url: "<?= base_url('/eliminar-tutores'); ?>",
                                dataType: 'json',
                                data: {
                                    cedulaTutor: $(aObject).data('id')
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
                nombreTutor: {
                    required: true
                },
                apellidoTutor: {
                    required: true,
                },
                cedulaTutor: {
                    required: true
                },
                telefonoTutor: {
                    required: true
                },
                correoTutor: {
                    required: true
                },
                carreraTutor: {
                    required: true
                },
                jornadaTutor: {
                    required: true
                }
            },
            messages: {
                nombreTutor: {
                    required: "Nombres obligatorio"
                },
                apellidoTutor: {
                    required: "Apellidos obligatorio",
                },
                cedulaTutor: {
                    required: "Cedula obligatoria"
                },
                telefonoTutor: {
                    required: "Telefono obligatorio"
                },
                carreraTutor: {
                    required: "Carrera obligatorio"
                },
                jornadaTutor: {
                    required: "Jornada obligatorio"
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
                $.post("<?= base_url('/gestion-tutores') ?>", $("#formDatos").serialize())
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
                                    Swal.fire("Información!", "Cédula o pasaporte inválido", "info!");
                                    break;
                            }
                            $("#formDatos")[0].reset();
                            $("#cedulaTutor").val("");
                        } else {
                            Swal.fire("Error!", "No se pudo procesar la información", "error");
                        }
                    })
                    .fail(function(err) {
                        Swal.fire("Error!", "Error: No se pudo procesar la información", "info");
                    })
                    .always(function() {
                        listarDatos();
                        $("#modalCenter").modal('hide');
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
                url: "<?= base_url('/buscar-tutores'); ?>",
                dataType: 'json',
                data: {
                    cedulaTutor: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#cedulaTutor").val(v.cedulaTutor);
                    $('#nombreTutor').val(v.nombreTutor);
                    $('#apellidoTutor').val(v.apellidoTutor);
                    $('#direccionTutor').val(v.direccionTutor);
                    $('#telefonoTutor').val(v.telefonoTutor);
                    $('#correoTutor').val(v.correoTutor);
                    $('#carreraTutor').val(v.carreraTutor);
                    $('#jornadaTutor').val(v.jornadaTutor);
                    $('#vigencia').val(v.vigenciaTutor);
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
        $("#formDatos")[0].reset();
        $("#cedulaTutor").val("");
        $("#modalCenterTitle").text("Tutor");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });
</script>
<?= $this->endSection(); ?>