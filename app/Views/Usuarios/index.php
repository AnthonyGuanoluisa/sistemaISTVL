<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador /</span> Usuarios</h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <!-- Modal -->
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Docente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idUsuario" id="idUsuario" value="" />
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="nombreUsuario" class="form-label">Nombre y Apellido</label>
                                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-3">
                                            <label for="cedulaUsuario" class="form-label">N.cedula (Parametro de ingreso al sistema)</label>
                                            <input type="text" name="cedulaUsuario" id="cedulaUsuario" class="form-control" pattern="\d{10}" title="Debe contener 10 dígitos" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-3">
                                            <label for="claveUsuario" class="form-label">Contraseña</label>
                                            <input type="password" name="claveUsuario" id="claveUsuario" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-3">
                                            <label for="confirClave" class="form-label">Confirmar Contraseña</label>
                                            <input type="password" name="confirClave" id="confirClave" class="form-control" aria-describedby="password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="cargoUsuario" class="form-label">Cargo</label>
                                            <select name="cargoUsuario" id="cargoUsuario" class="form-select" onchange="toggleCarrera()">
                                                <?php if ($tipoCargo) { ?>
                                                    <option value="">SELECCIONE...</option>
                                                    <?php foreach ($tipoCargo as $dp) { ?>
                                                        <option id="<?= $dp->NombreCargo; ?>" value="<?= $dp->idCargo; ?>"><?= $dp->NombreCargo; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col mb-0">
                                            <label for="carreraUsuario" class="form-label">Carrera</label>
                                            <select name="carreraUsuario" id="carreraUsuario" class="form-select">
                                                <?php if ($carreras) { ?>
                                                    <option value="">SELECCIONE...</option>
                                                    <?php foreach ($carreras as $dp) { ?>
                                                        <option value="<?= $dp->idCarrera; ?>"><?= $dp->NombreCarrera; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>  
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

    function toggleCarrera() {
        const cargoUsuario = document.getElementById('cargoUsuario');
        const carreraUsuario = document.getElementById('carreraUsuario');

        const disabledCargos = ['ADMINISTRADOR', 'COORDINADOR']; 
        const selectedOption = cargoUsuario.options[cargoUsuario.selectedIndex];
        const cargoName = selectedOption.id; 
        if (disabledCargos.includes(cargoName)) {
            carreraUsuario.disabled = true;
        } else {
            carreraUsuario.disabled = false;
        }
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
        $("#listadoDatos").load("<?= base_url('/lista-usuarios'); ?>", {
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
                $("#idUsuario").val("");
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
                                url: "<?= base_url('/eliminar-usuarios'); ?>",
                                dataType: 'json',
                                data: {
                                    idUsuario: $(aObject).data('id')
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
                nombreUsuario: {
                    required: true
                },
                cedulaUsuario: {
                    required: true,
                },
                claveUsuario: {
                    required: true
                },
                confirClave: {
                    required: true,
                    equalTo: "#claveUsuario"
                },
                cargoUsuario: {
                    required: true
                },
                
            },
            messages: {
                nombreUsuario: {
                    required: "Nombre y Apellido son obligatorios"
                },
                cedulaUsuario: {
                    required: "Correo es obligatorio",
                },
                claveUsuario: {
                    required: "Contraseña es obligatoria"
                },
                confirClave: {
                    required: "Confirmar la Contraseña",
                    equalTo: "Las contraseñas no coinciden"
                },
                cargoUsuario: {
                    required: "Cargo es obligatorio"
                },
                
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

                $.post("<?= base_url('/gestion-usuarios') ?>", $("#formDatos").serialize())
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
                                    Swal.fire("Información!", "El Usuario Ya se encuentra Registrado", "info");
                                    break;
                                case 'f':
                                    Swal.fire("Información!", "Cédula inválida", "info!");
                                    break;
                            }
                            $("#formDatos")[0].reset();
                            $("#idUsuario").val("");
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
                url: "<?= base_url('/buscar-usuarios'); ?>",
                dataType: 'json',
                data: {
                    idUsuario: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idUsuario").val(v.idUsuario);
                    $('#nombreUsuario').val(v.nombreUsuario);
                    $('#cedulaUsuario').val(v.cedulaUsuario);
                    $('#claveUsuario').val(v.confirClave);
                    $('#confirClave').val(v.confirClave);
                    $('#cargoUsuario').val(v.cargoUsuario);
                    $('#carreraUsuario').val(v.carreraUsuario);
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
        $("#idUsuario").val("");
        $("#modalCenterTitle").text("Docente");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });
</script>

<?= $this->endSection(); ?>