<?= $this->extend('Views/Dashboard/plantillaVinculacion'); ?>

<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span id="displayComment" class="text-muted fw-light">Vinculacion/</span>Estudiantes<span id="dynamic-content"></span></h4>
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
                                    <h5 class="modal-title" id="modalCenterTitle">Estudiantes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post">
                                    <div class="form-group">
                                        <div class="col mb-2">
                                            <label for="nombresEstudiante" class="form-label">Nombres</label>
                                            <input type="text" name="nombresEstudiante" id="nombresEstudiante" class="form-control" />
                                        </div>
                                        <div class="col mb-2">
                                            <label for="apellidosEstudiante" class="form-label">Apellidos</label>
                                            <input type="text" name="apellidosEstudiante" id="apellidosEstudiante" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="cedulaEstudiante" class="form-label">Cedula</label>
                                                <input type="text" name="cedulaEstudiante" id="cedulaEstudiante" class="form-control" pattern="\d{10}" title="Debe contener 10 dígitos" required />
                                            </div>
                                            <div class="col mb-2">
                                                <label for="sexoEstudiante" class="form-label">Genero</label>
                                                <select name="sexoEstudiante" id="sexoEstudiante" class="form-select">
                                                    <option selected>SELECCIONE..</option>
                                                    <option value="Femenino">Femenino</option>
                                                    <option value="Masculino">Masculino</option>
                                                </select>
                                            </div>
                                            <div class="col mb-2">
                                                <label for="telefonoEstudiante" class="form-label">Telefono</label>
                                                <input type="text" name="telefonoEstudiante" id="telefonoEstudiante" class="form-control" required oninput="validarTelefono(this)" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="correoEstudiante" class="form-label">Correo</label>
                                                <input type="email" name="correoEstudiante" id="correoEstudiante" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="cicloEstudinte" class="form-label">Ciclo</label>
                                                <select name="cicloEstudinte" id="cicloEstudinte" class="form-select">
                                                    <?php if ($ciclo) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($ciclo as $dp) { ?>
                                                            <option value="<?= $dp->idPeriodos; ?>"><?= $dp->tipoCiclo; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="jornadaEstudiante" class="form-label">Jornada</label>
                                                <select name="jornadaEstudiante" id="jornadaEstudiante" class="form-select">
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
                                            <label for="carreraEstudiante" class="form-label">Carrera</label>
                                            <select name="carreraEstudiante" id="carreraEstudiante" class="form-select">
                                                <option value="<?= $carreraUsuario; ?>"><?= $nombreCarreraUsuario; ?></option>
                                            </select>
                                        </div>
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
    function validarTelefono(input) {
        var telefono = input.value;
        var isValid = validarCelular(telefono);

        if (!isValid) {
            document.getElementById("telefonoError").innerHTML = "Teléfono no válido.";
        } else {
            document.getElementById("telefonoError").innerHTML = "";
        }
    }

    function validarCelular(celular) {
        celular = celular.replace(/ /g, '').replace(/\+/g, '');

        if (celular.substring(0, 3) === '593') {
            celular = celular.substring(3);
        }

        if (celular.substring(0, 2) !== '09' && celular[0] !== '9') {
            return false;
        }

        if (celular.length != 10) {
            return false;
        }

        if (!/^\d+$/.test(celular)) {
            return false;
        }

        return true;
    }


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
        $("#listadoDatos").load("<?= base_url('/lista-estudiantes-asignacion'); ?>", {
            urlCode
        }, function(responseText, statusText, xhr) {
            if (statusText == "success") {
                $(function() {
                    $('#tabla').DataTable();
                });
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
                $("#cedulaEstudiante").val("");
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
                                url: "<?= base_url('/eliminar-estudiantes-asignacion'); ?>",
                                dataType: 'json',
                                data: {
                                    cedulaEstudiante: $(aObject).data('id')
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
                                Swal.fire("Error!", "Error: No se puede eliminar al estudiante, debido a que se encuentra realizando una de las Actividades", "info");
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
                nombresEstudiante: {
                    required: true
                },
                apellidosEstudiante: {
                    required: true,
                },
                sexoEstudiante: {
                    required: true
                },
                cicloEstudinte: {
                    required: true
                },
                carreraEstudiante: {
                    required: true
                },
                correoEstudiante: {
                    required: true
                },
                jornadaEstudiante: {
                    required: true
                }
            },
            messages: {
                nombresEstudiante: {
                    required: "Nombres obligatorio"
                },
                apellidosEstudiante: {
                    required: "Apellidos obligatorio",
                },
                sexoEstudiante: {
                    required: "Genero obligatorio"
                },
                cicloEstudinte: {
                    required: "Ciclo obligatorio"
                },
                carreraEstudiante: {
                    required: "Carrera obligatoria"
                },
                correoEstudiante: {
                    required: "Correo obligatorio"
                },
                jornadaEstudiante: {
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
                $.post("<?= base_url('/gestion-estudiantes-asignacion') ?>", $("#formDatos").serialize())
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
                            $("#cedulaEstudiante").val("");
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
                url: "<?= base_url('/buscar-estudiantes-asignacion'); ?>",
                dataType: 'json',
                data: {
                    cedulaEstudiante: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#cedulaEstudiante").val(v.cedulaEstudiante);
                    $('#nombresEstudiante').val(v.nombresEstudiante);
                    $('#apellidosEstudiante').val(v.apellidosEstudiante);
                    $('#sexoEstudiante').val(v.sexoEstudiante);
                    $('#cicloEstudinte').val(v.cicloEstudinte);
                    $('#carreraEstudiante').val(v.carreraEstudiante);
                    $('#jornadaEstudiante').val(v.jornadaEstudiante);
                    $('#correoEstudiante').val(v.correoEstudiante);
                    $('#telefonoEstudiante').val(v.telefonoEstudiante);
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
        $("#cedulaEstudiante").val("");
        $("#modalCenterTitle").text("Estudiante");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });

    document.addEventListener('DOMContentLoaded', function() {
        var params = new URLSearchParams(window.location.search);
        var content = params.get('content');
        if (content) {
            document.getElementById('dynamic-content').innerText = decodeURIComponent(content);
        }
    });
</script>

<?= $this->endSection(); ?>