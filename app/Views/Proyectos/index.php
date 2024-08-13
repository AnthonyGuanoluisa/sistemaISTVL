<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>

<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador / Listados Vinculacion /</span> Proyectos</h4>
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
                                    <h5 class="modal-title" id="modalCenterTitle">Proyectos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idProyecto" id="idProyecto" value="" />
                                    <div class="form-group">
                                        <div class="col mb-0">
                                            <label for="carreraProyecto" class="form-label">Carrera</label>
                                            <select name="carreraProyecto" id="carreraProyecto" class="form-select" onchange="cargarEmpresasPorCarrerasVinculacion(this.value)">
                                                <?php if ($carrera) { ?>
                                                    <option value="">SELECCIONE...</option>
                                                    <?php foreach ($carrera as $dp) { ?>
                                                        <?php if (strtolower($dp->NombreCarrera) != 'coordinacion') { ?>
                                                            <option value="<?= $dp->idCarrera; ?>"><?= $dp->NombreCarrera; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col mb-2">
                                            <label for="empresaProyecto" class="form-label">Empresa</label>
                                            <select name="empresaProyecto" id="empresaProyecto" class="form-select">
                                                <option value="">SELECCIONE...</option>
                                            </select>
                                        </div>
                                        <div class="col mb-2">
                                            <label for="nombreProyecto" class="form-label">Nombre De Proyecto</label>
                                            <input type="text" name="nombreProyecto" id="nombreProyecto" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="codigoProyecto" class="form-label">Codigo</label>
                                                <input type="text" name="codigoProyecto" id="codigoProyecto" class="form-control" />
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
        $("#listadoDatos").load("<?= base_url('/lista-proyectos'); ?>", {
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
                $("#idProyecto").val("");
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
                                url: "<?= base_url('/eliminar-proyectos'); ?>",
                                dataType: 'json',
                                data: {
                                    idProyecto: $(aObject).data('id')
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
                                Swal.fire("Información!", "El proyecto esta en uso", "info");
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
                empresaProyecto: {
                    required: true
                },
                nombreProyecto: {
                    required: true,
                },
                carreraProyecto: {
                    required: true
                },
                codigoProyecto: {
                    required: true
                }
            },
            messages: {
                empresaProyecto: {
                    required: "Empresa obligatorio"
                },
                nombreProyecto: {
                    required: "Nombre obligatorio",
                },
                carreraProyecto: {
                    required: "Carrera obligatorio"
                },
                codigoProyecto: {
                    required: "Codigo obligatorio"
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
                $.post("<?= base_url('/gestion-proyectos') ?>", $("#formDatos").serialize())
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
                            $("#idProyecto").val("");
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
                url: "<?= base_url('/buscar-proyectos'); ?>",
                dataType: 'json',
                data: {
                    idProyecto: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idProyecto").val(v.idProyecto);
                    $('#nombreProyecto').val(v.nombreProyecto);
                    $('#carreraProyecto').val(v.carreraProyecto);
                    $('#codigoProyecto').val(v.codigoProyecto);
                    cargarEmpresasPorCarrerasVinculacion(v.carreraProyecto);
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
        $("#idProyecto").val("");
        $("#modalCenterTitle").text("Proyecto");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });

    function cargarEmpresasPorCarrerasVinculacion(id) {
        console.log('ID de la carrera seleccionada:', id);
        if (id > 0) {
            $.ajax({
                    type: 'post',
                    url: "<?= base_url('/buscarEmpresaCarreraVin'); ?>",
                    dataType: 'json',
                    data: {
                        carreraEmpresa: id, // Cambia la clave del objeto data
                    }
                })
                .done(function(data, textStatus, xhr) {
                    console.log('Respuesta del servidor:', data);
                    try {
                        $('#empresaProyecto').empty(); // Limpiar el select
                        if (data.length > 0) {
                            $.each(data, function(index, empresa) {
                                $('#empresaProyecto').append('<option value="' + empresa.idEmpresa + '">' + empresa.nombreEmpresa + '</option>');
                            });
                        } else {
                            $('#empresaProyecto').append('<option value="">No hay empresa para esta carrera</option>');
                        }
                    } catch (e) {
                        console.error('Error al cargar los proyectos:', e);
                    }
                })
                .fail(function(xhr, textStatus, errorThrown) {
                    console.error('Error al cargar los proyectos:', errorThrown);
                });
        }
    }
</script>

<?= $this->endSection(); ?>