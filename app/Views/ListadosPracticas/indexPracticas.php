<?= $this->extend('Views/Dashboard/plantillaPracticas'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Practicas /</span> Listado</h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Listado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idPracticas" id="idPracticas" value="" />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="nombreEstudiante" class="form-label">Estudiante</label>
                                                <select name="nombreEstudiante" id="nombreEstudiante" class="form-select">
                                                    <?php if ($cedulaEstudiante) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($cedulaEstudiante as $dp) { ?>
                                                            <option value="<?= $dp->id; ?>"><?= $dp->NombreCompleto; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-2">
                                                <label for="empresaPracticas" class="form-label">Empresas</label>
                                                <select name="empresaPracticas" id="empresaPracticas" class="form-select">
                                                    <?php if ($empresa) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($empresa as $dp) { ?>
                                                            <option value="<?= $dp->nombreEmpresa; ?>"><?= $dp->nombreEmpresa; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="horasPracticas" class="form-label">Horas</label>
                                                <input type="text" name="horasPracticas" id="horasPracticas" class="form-control" />
                                            </div>
                                        </div>
                                        <?php
                                        $idCarrera = session()->get('idCarrera');
                                        $carreraUsuario = session()->get('carreraUsuario');
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <label for="carreraPracticas" class="form-label">Carreras</label>
                                                    <select name="carreraPracticas" id="carreraPracticas" class="form-select">
                                                        <option value="<?= $idCarrera; ?>"><?= $carreraUsuario; ?></option>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="fechaInicio" class="form-label">Fecha_Inicio</label>
                                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="fechaFin" class="form-label">Fecha_Fin</label>
                                                    <input type="date" name="fechaFin" id="fechaFin" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col mb-2">
                                                    <label for="cursoPracticas" class="form-label">Curso</label>
                                                    <select name="cursoPracticas" id="cursoPracticas" class="form-select">
                                                        <?php if ($cursos) { ?>
                                                            <option value="">SELECCIONE...</option>
                                                            <?php foreach ($cursos as $dp) { ?>
                                                                <option value="<?= $dp->Curso; ?>"><?= $dp->Curso; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="tutorPracticas" class="form-label">Tutor</label>
                                                    <select name="tutorPracticas" id="tutorPracticas" class="form-select">
                                                        <?php if ($tutores) { ?>
                                                            <option value="">SELECCIONE...</option>
                                                            <?php foreach ($tutores as $dp) { ?>
                                                                <option value="<?= $dp->NombreCompleto; ?>"><?= $dp->NombreCompleto; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div id="formGroup" class="form-group" style="border: 2px solid red; padding: 10px; margin-bottom: 10px;">
                                            <p id="mensaje" style="color: red; font-weight: bold;"></p>
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="horasCulminacion" class="form-label">Horas Cumplidas</label>
                                                    <input type="text" name="horasCulminacion" id="horasCulminacion" class="form-control" onchange="cambiarEstado()" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="aprobadoPracticas" class="form-label">Aprobado</label>
                                                    <select name="aprobadoPracticas" id="aprobadoPracticas" class="form-select" onchange="cambiarEstado()">
                                                        <option value="" selected>SELECCIONE..</option>
                                                        <option value="SI">SI</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('horasCulminacion');

        var savedValue = localStorage.getItem('horasCulminacion');
        if (savedValue) {
            select.value = savedValue;
        }
        cambiarEstado();

        select.addEventListener('change', function() {
            localStorage.setItem('horasCulminacion', select.value);
            cambiarEstado();
        });
        setInterval(cambiarEstado, 1000);

        function cambiarEstado() {
            var horasPracticas = parseInt(document.getElementById('horasPracticas').value);
            var horasCulminacion = parseInt(document.getElementById('horasCulminacion').value);
            var aprobadoPracticas = document.getElementById('aprobadoPracticas');
            var formGroup = document.getElementById('formGroup');

            if (horasCulminacion < horasPracticas) {
                document.getElementById('horasCulminacion').style.borderColor = "red";
                document.getElementById('formGroup').style.borderColor = "red";
                aprobadoPracticas.value = "NO";
            } else {
                document.getElementById('horasCulminacion').style.borderColor = ""; // Restaurar el color del borde
                if (horasCulminacion === horasPracticas) {
                    aprobadoPracticas.value = "SI"; // Seleccionar automáticamente "SI"
                    formGroup.style.borderColor = "green"; // Cambiar el color del borde a verde
                } else {
                    formGroup.style.borderColor = "red"; // Restaurar el color del borde a rojo
                }
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        listarDatos();
    });

    function listarDatos() {
        showSpinner();
        var urlCode = "<?php echo $urlCode; ?>";
        $("#listadoDatos").load("<?= base_url('/lista-listadoPracticas'); ?>", {
            urlCode
        }, function(responseText, statusText, xhr) {
            $(function() {
                $('#tabla').DataTable();
            });
            if (statusText == "success") {
                hideSpinner();
            }
            if (statusText == "error") {
                Swal.fire("Error!", "No se pudo cargar el listado", "info");
                hideSpinner();
            }
        });
    }

    function gestionRegistro(aObject) {
        let accion = $(aObject).data('accion');
        document.getElementById("formDatos").reset();

        switch (accion) {
            case 'insertarRegistro':
                $("#idPracticas").val("");
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
                                url: "<?= base_url('/eliminar-listadosPracticas'); ?>",
                                dataType: 'json',
                                data: {
                                    idPracticas: $(aObject).data('id')
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
            case 'enviarAprobado':
                enviarAprobado(
                    $(aObject).data('cedula'),
                    $(aObject).data('nombrecompleto'),
                    $(aObject).data('empresa'),
                    $(aObject).data('carrera'),
                    $(aObject).data('fecha_inicio'),
                    $(aObject).data('fecha_fin'),
                    $(aObject).data('horas')
                );
                break;
            case 'pendiente':
                Swal.fire("Información!", "Falta Completar Horas", "info");
                break;
            default:
                Swal.fire("Información!", "Opción desconocida", "error");
                break;
        }
    }

    $(document).ready(function() {

        $('#formDatos').validate({
            rules: {
                nombreEstudiante: {
                    required: true
                },
                empresaPracticas: {
                    required: true
                },
                horasPracticas: {
                    required: true
                },
                carreraPracticas: {
                    required: true
                },
                fechaInicio: {
                    required: true
                },
                fechaFin: {
                    required: true
                },
                cicloPracticas: {
                    required: true
                },
                cursoPracticas: {
                    required: true
                },
                tutorPracticas: {
                    required: true
                },
            },
            messages: {

                nombreEstudiante: {
                    required: "Agregar Estudiante, Obligatorio"
                },
                empresaPracticas: {
                    required: "Agregar Empresa Obligatorio",
                },
                horasPracticas: {
                    required: "Establecer Hora, Obligatorio"
                },
                carreraPracticas: {
                    required: "Carrera obligatorio"
                },
                fechaInicio: {
                    required: "Establecer Fecha, obligatorio"
                },
                fechaFin: {
                    required: "Establecer Fecha, obligatorio"
                },
                cicloPracticas: {
                    required: "Ciclo Academico obligatorio"
                },
                cursoPracticas: {
                    required: "Curso obligatorio"
                },
                tutorPracticas: {
                    required: "Tutor obligatorio"
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
                $.post("<?= base_url('/gestion-listadosPracticas') ?>", $("#formDatos").serialize())
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
                                    Swal.fire("Información!", "Cupos Agotados", "error");
                                    break;
                                case 'f':
                                    Swal.fire("Información!", "El estudiante ya se encuentra realizando practicas", "info");
                                    break;
                            }
                            $("#formDatos")[0].reset();
                            $("#idPracticas").val("");
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
                url: "<?= base_url('/buscar-listadosPracticas'); ?>",
                dataType: 'json',
                data: {
                    idPracticas: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idPracticas").val(v.idPracticas);
                    $('#nombreEstudiante').val(v.Cedula);
                    $('#empresaPracticas').val(v.Empresa);
                    $('#horasPracticas').val(v.Horas);
                    $('#fechaInicio').val(v.Fecha_Inicio);
                    $('#fechaFin').val(v.Fecha_Fin);
                    $('#cicloPracticas').val(v.Ciclo_Academico);
                    $('#cursoPracticas').val(v.Curso);
                    $('#tutorPracticas').val(v.Tutor_Academico);

                    $('#horasCulminacion').val(v.Total_Horas);
                    $('#aprobadoPracticas').val(v.Aprobado);

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
        $("#idPracticas").val("");
        $("#modalCenterTitle").text("Listado");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });

    function enviarAprobado(cedula, nombreCompleto, empresa, carrera, fechaInicio, fechaFin, horas) {
        $.ajax({
                type: 'post',
                url: "<?= base_url('aprobado-practicas') ?>",
                dataType: 'json',
                data: {
                    Cedula: cedula,
                    NombreCompleto: nombreCompleto,
                    Empresa: empresa,
                    Carrera: carrera,
                    Fecha_Inicio: fechaInicio,
                    Fecha_fin: fechaFin,
                    Horas: horas
                }
            })
            .done(function(response) {
                if (response.status === 'success') {
                    Swal.fire("Éxito!", response.message, "success");
                } else {
                    Swal.fire("Éxito!", response.message, "success");
                }
            })
            .fail(function() {
                Swal.fire("Error!", "Error: No se pudo enviar los datos", "error");
            });
    }
</script>

<?= $this->endSection(); ?>