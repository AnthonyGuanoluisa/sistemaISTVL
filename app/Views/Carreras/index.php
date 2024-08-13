<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador /</span> Carreras</h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Carrera</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idCarrera" id="idCarrera" value="" />
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="NombreCarrera" class="form-label">Carrera</label>
                                            <input type="text" name="NombreCarrera" id="NombreCarrera" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="codigoCarrera" class="form-label">Codigo</label>
                                            <input type="text" name="codigoCarrera" id="codigoCarrera" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
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
        $("#listadoDatos").load("<?= base_url('/lista-carreras'); ?>", {
            urlCode,
        }, function(responseText, statusText, xhr) {
            if (statusText === "success") {
                hideSpinner();
            } else if (statusText === "error") {
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
                $("#idCarrera").val("");
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
                    title: '¿Eliminar?',
                    text: "Se borrará el registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url('/eliminar-carreras'); ?>",
                            dataType: 'json',
                            data: {
                                idCarrera: $(aObject).data('id')
                            }
                        }).done(function(data) {
                            if (data) {
                                Swal.fire("Eliminado!", "Registro eliminado", "success");
                            } else {
                                Swal.fire("Error!", "No se pudo eliminar", "error");
                            }
                        }).fail(function() {
                            Swal.fire("Error!", "Error: No se pudo eliminar", "error");
                        }).always(function() {
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
                NombreCarrera: {
                    required: true
                },
                codigoCarrera: {
                    required: true
                }
            },
            messages: {
                NombreCarrera: {
                    required: "Parametro obligatorio"
                },
                codigoCarrera: {
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
                $.post("<?= base_url('/gestion-carreras') ?>", $("#formDatos").serialize())
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
                            $("#idCarrera").val("");
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
                url: "<?= base_url('/buscar-carreras'); ?>",
                dataType: 'json',
                data: {
                    idCarrera: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idCarrera").val(v.idCarrera);
                    $('#NombreCarrera').val(v.NombreCarrera);
                    $('#codigoCarrera').val(v.codigoCarrera);
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
        $("#idCarrera").val("");
        $("#modalCenterTitle").text("Carrera");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });
</script>
<?= $this->endSection(); ?>