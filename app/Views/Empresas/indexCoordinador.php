<?= $this->extend('Views/Dashboard/plantillaCoordinador'); ?>
<?= $this->section('contenido'); ?>
<!-- Content -->
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span id="displayComment" class="text-muted fw-light">Coordinador/<span id="dynamic-content">Empresas</span></h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <!-- Modal -->
                    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel4">Empresa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idEmpresa" id="idEmpresa" value="" />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="nombreEmpresa" class="form-label">Nombre</label>
                                                <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="directEmpresa" class="form-label">Direccion</label>
                                                <input type="text" name="directEmpresa" id="directEmpresa" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="rucEmpresa" class="form-label">RUC</label>
                                                <input type="text" name="rucEmpresa" id="rucEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="teleEmpresa" class="form-label">Contacto</label>
                                                <input type="text" name="teleEmpresa" id="teleEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="cuposEmpresa" class="form-label">Cupos</label>
                                                <input type="number" name="cuposEmpresa" id="cuposEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-2">
                                                <label for="convEmpresa" class="form-label">Fecha Inicio Convenio</label>
                                                <input type="date" name="convEmpresa" id="convEmpresa" class="form-control" />
                                            </div>
                                            <div class="col mb-2">
                                                <label for="caduEmpresa" class="form-label">Fecha Fin Convenio</label>
                                                <input type="date" name="caduEmpresa" id="caduEmpresa" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="nombreEncargado" class="form-label">Encargado</label>
                                                <input type="text" name="nombreEncargado" id="nombreEncargado" class="form-control" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="correoEmpresa" class="form-label">Correo</label>
                                                <input type="email" name="correoEmpresa" id="correoEmpresa" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-0">
                                                <label for="asignacionEmpresa" class="form-label">Asignacion</label>
                                                <select name="asignacionEmpresa" id="asignacionEmpresa" class="form-select">
                                                    <option value="<?= $idAsig; ?>"><?= $NombreAsig; ?></option>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="carreraEmpresa" class="form-label">Carrera</label>
                                                <select name="carreraEmpresa" id="carreraEmpresa" class="form-select">
                                                    <?php if ($carreras) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($carreras as $dp) { ?>
                                                            <?php if (strtolower($dp->NombreCarrera) != 'COORDINACIÓN') { ?>
                                                                <option value="<?= $dp->idCarrera; ?>"><?= $dp->NombreCarrera; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="codigoEmpresa" class="form-label">Codigo</label>
                                                <input type="text" name="codigoEmpresa" id="codigoEmpresa" class="form-control" />
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

    function getQueryParam(param) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function listarDatos() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        var name = "<?php echo $name; ?>";
        $("#listadoDatos").load("<?= base_url('/lista-empresasCoordinador'); ?>", {
            urlCode: urlCode,
            name: name
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
                $("#idEmpresa").val("");
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
                                url: "<?= base_url('/eliminar-empresas'); ?>",
                                dataType: 'json',
                                data: {
                                    idEmpresa: $(aObject).data('id')
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
                                Swal.fire("Información!", "La empresa esta siendo ocupada", "info");
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
                nombreEmpresa: {
                    required: true
                },
                rucEmpresa: {
                    required: true,
                },
                convEmpresa: {
                    required: true
                },
                caduEmpresa: {
                    required: true
                },
                cuposEmpresa: {
                    required: true
                },
                asignacionEmpresa: {
                    required: true
                },
                carreraEmpresa: {
                    required: true
                },
                codigoEmpresa: {
                    required: true
                },
                directEmpresa: {
                    required: true
                },
                teleEmpresa: {
                    required: true
                },
                nombreEncargado: {
                    required: true
                },
                correoEmpresa: {
                    required: true
                }
            },
            messages: {
                nombreEmpresa: {
                    required: "Nombre obligatorio"
                },
                rucEmpresa: {
                    required: "RUC obligatorio",
                },
                convEmpresa: {
                    required: "Fecha de inico es obligatoria"
                },
                caduEmpresa: {
                    required: "Fecha de fin es obligatoria"
                },
                cuposEmpresa: {
                    required: "Cupos  obligatorio"
                },
                asignacionEmpresa: {
                    required: "Asignacion obligatoria"
                },
                carreraEmpresa: {
                    required: "Carrera obligatorio"
                },
                codigoEmpresa: {
                    required: "Codigo obligatorio"
                },
                directEmpresa: {
                    required: "Direccioón obligatorio"
                },
                teleEmpresa: {
                    required: "Contacto obligatorio"
                },
                nombreEncargado: {
                    required: "Encargado obligatorio"
                },
                correoEmpresa: {
                    required: "Correo obligatorio"
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
                $.post("<?= base_url('/gestion-empresas') ?>", $("#formDatos").serialize())
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
                            $("#idEmpresa").val("");
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
                url: "<?= base_url('/buscar-empresas-asignacion'); ?>",
                dataType: 'json',
                data: {
                    idEmpresa: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idEmpresa").val(v.idEmpresa);
                    $('#nombreEmpresa').val(v.nombreEmpresa);
                    $('#nombreEncargado').val(v.nombreEncargado);
                    $('#rucEmpresa').val(v.rucEmpresa);
                    $('#directEmpresa').val(v.directEmpresa);
                    $('#correoEmpresa').val(v.correoEmpresa);
                    $('#teleEmpresa').val(v.teleEmpresa);
                    $('#convEmpresa').val(v.convEmpresa);
                    $('#caduEmpresa').val(v.caduEmpresa);
                    $('#cuposEmpresa').val(v.cuposEmpresa);
                    $('#asignacionEmpresa').val(v.asignacionEmpresa);
                    $('#carreraEmpresa').val(v.carreraEmpresa);
                    $('#codigoEmpresa').val(v.codigoEmpresa);
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
        $("#idEmpresa").val("");
        $("#exampleModalLabel4").text("Empresa");
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