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
                                <div style="text-align: center;">
                                    <label class="form-label" style="font-size: 24px; color: #4d8495 ;">PRACTICAS Uno</label>
                                </div>
                                <form class="modal-body" id="formDatos" method="post" onsubmit="convertToUppercase();">
                                    <input type="hidden" name="idPracticasDSW" id="idPracticasDSW" value="" />
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
                                                <label for="empresaPracticasUNO" class="form-label">Empresas</label>
                                                <select name="empresaPracticasUNO" id="empresaPracticasUNO" class="form-select">
                                                    <?php if ($empresa) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($empresa as $dp) { ?>
                                                            <option value="<?= $dp->nombreEmpresa; ?>"><?= $dp->nombreEmpresa; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="horasPracticasUNO" class="form-label">Horas</label>
                                                <input type="text" name="horasPracticasUNO" id="horasPracticasUNO" class="form-control" />
                                            </div>
                                        </div>
                                        <?php
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <label for="carreraPracticas" class="form-label">Carrera</label>
                                                    <select name="carreraPracticas" id="carreraPracticas" class="form-select">
                                                        <?php if ($carreras) { ?>
                                                            <?php foreach ($carreras as $dp) { ?>
                                                                <?php if (strtolower($dp->NombreCarrera) == 'desarrollo de software') { ?>
                                                                    <option value="<?= $dp->NombreCarrera; ?>"><?= $dp->NombreCarrera; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="fechaInicioUNO" class="form-label">Fecha_Inicio</label>
                                                    <input type="date" name="fechaInicioUNO" id="fechaInicioUNO" class="form-control" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="fechaFinUNO" class="form-label">Fecha_Fin</label>
                                                    <input type="date" name="fechaFinUNO" id="fechaFinUNO" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <label for="cursoPracticasUNO" class="form-label">Curso</label>
                                                    <select name="cursoPracticasUNO" id="cursoPracticasUNO" class="form-select">
                                                        <?php if ($cursos) { ?>
                                                            <option value="">SELECCIONE...</option>
                                                            <?php foreach ($cursos as $dp) { ?>
                                                                <option value="<?= $dp->Curso; ?>"><?= $dp->Curso; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="tutorPracticasUNO" class="form-label">Tutor Encargado</label>
                                                    <select name="tutorPracticasUNO" id="tutorPracticasUNO" class="form-select">
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
                                        <div id="formGroup2" class="form-group" style="border: 2px solid #ced7d0; padding: 10px; margin-bottom: 10px;">
                                            <p id="mensaje" style="color: red; font-weight: bold;"></p>
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="horasCum1" class="form-label">Horas Cumplidas 1ER Periodo</label>
                                                    <input type="text" name="horasCum1" id="horasCum1" class="form-control" onchange="estado()" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="terminado" class="form-label">Cumplio</label>
                                                    <select name="terminado" id="terminado" class="form-select" onchange="estado()">
                                                        <option value="" selected>SELECCIONE..</option>
                                                        <option value="SI">SI</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div style="text-align: center;">
                                            <label class="form-label" style="font-size: 24px; color: #4d8495  ;">PRACTICAS 2do PERIODO</label>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="empresaDOS" class="form-label">Empresas</label>
                                                <select name="empresaDOS" id="empresaDOS" class="form-select">
                                                    <?php if ($empresa) { ?>
                                                        <option value="">SELECCIONE...</option>
                                                        <?php foreach ($empresa as $dp) { ?>
                                                            <option value="<?= $dp->nombreEmpresa; ?>"><?= $dp->nombreEmpresa; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="horasDOS" class="form-label">Horas</label>
                                                <input type="text" name="horasDOS" id="horasDOS" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <label for="fechaInicioDOS" class="form-label">Fecha_Inicio</label>
                                                    <input type="date" name="fechaInicioDOS" id="fechaInicioDOS" class="form-control" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="fechaFinDOS" class="form-label">Fecha_Fin</label>
                                                    <input type="date" name="fechaFinDOS" id="fechaFinDOS" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <label for="cursoPracticasDOS" class="form-label">Curso</label>
                                                    <select name="cursoPracticasDOS" id="cursoPracticasDOS" class="form-select">
                                                        <?php if ($cursos) { ?>
                                                            <option value="">SELECCIONE...</option>
                                                            <?php foreach ($cursos as $dp) { ?>
                                                                <option value="<?= $dp->Curso; ?>"><?= $dp->Curso; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="tutorPracticasDOS" class="form-label">Tutor Encargado</label>
                                                    <select name="tutorPracticasDOS" id="tutorPracticasDOS" class="form-select">
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
                                        <div id="formGroup" class="form-group" style="border: 2px solid #ced7d0; padding: 10px; margin-bottom: 10px;">
                                            <p id="mensaje" style="color: red; font-weight: bold;"></p>
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="horasCum2" class="form-label">Horas Cumplidas PRACTICAS DOS</label>
                                                    <input type="text" name="horasCum2" id="horasCum2" class="form-control" onchange="cambiarEstado()" />
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="terminadoDOS" class="form-label">Cumplio</label>
                                                    <select name="terminadoDOS" id="terminadoDOS" class="form-select" onchange="cambiarEstado()">
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
        var select = document.getElementById('horasCum2');
        localStorage.removeItem('horasCum2');

        var savedValue = localStorage.getItem('horasCum2');
        if (savedValue) {
            select.value = savedValue;
        }
        cambiarEstado();

        select.addEventListener('change', function() {
            localStorage.setItem('horasCum2', select.value);
            cambiarEstado();
        });
        setInterval(cambiarEstado, 1000);

        function cambiarEstado() {
            var horasPracticas = parseInt(document.getElementById('horasDOS').value);
            var horasCulminacion = parseInt(document.getElementById('horasCum2').value);
            var aprobadoPracticas = document.getElementById('terminadoDOS');
            var formGroup = document.getElementById('formGroup');

            if (horasCulminacion < horasPracticas) {
                document.getElementById('formGroup').style.borderColor = "#ced7d0";
                aprobadoPracticas.value = "NO";
            } else {
                document.getElementById('horasCum2').style.borderColor = "";
                if (horasCulminacion === horasPracticas) {
                    aprobadoPracticas.value = "SI";
                    formGroup.style.borderColor = "green";
                } else {
                    formGroup.style.borderColor = "#ced7d0";
                }
            }
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('horasCum1');
        localStorage.removeItem('horasCum1');

        var savedValue = localStorage.getItem('horasCum1');
        if (savedValue) {
            select.value = savedValue;
        }
        estado();

        select.addEventListener('change', function() {
            localStorage.setItem('horasCum1', select.value);
            estado();
        });
        setInterval(estado, 1000);

        function estado() {
            var horasPracticas = parseInt(document.getElementById('horasPracticasUNO').value);
            var horasCulminacion = parseInt(document.getElementById('horasCum1').value);
            var aprobadoPracticas = document.getElementById('terminado');
            var formGroup = document.getElementById('formGroup2');

            if (horasCulminacion < horasPracticas) {
                document.getElementById('formGroup2').style.borderColor = "#ced7d0";
                aprobadoPracticas.value = "NO";
            } else {
                document.getElementById('horasCum2').style.borderColor = ""; // Restaurar el color del borde
                if (horasCulminacion === horasPracticas) {
                    aprobadoPracticas.value = "SI"; // Seleccionar automáticamente "SI"
                    formGroup.style.borderColor = "green"; // Cambiar el color del borde a verde
                } else {
                    formGroup.style.borderColor = "#ced7d0"; // Restaurar el color del borde a rojo
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
        $("#listadoDatos").load("<?= base_url('/lista-listadoPracticasDSW'); ?>", {
            urlCode
        }, function(responseText, statusText, xhr) {
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
                $("#idPracticasDSW").val("");
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
                                url: "<?= base_url('/eliminar-listadoPracticasDSW'); ?>",
                                dataType: 'json',
                                data: {
                                    idPracticasDSW: $(aObject).data('id')
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
                    $(aObject).data('horas'),
                    $(aObject).data('empresa2'),
                    $(aObject).data('fecha_inicio2'),
                    $(aObject).data('fecha_fin2'),
                    $(aObject).data('horas2'),
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
                empresaPracticasUNO: {
                    required: true
                },
                horasPracticasUNO: {
                    required: true
                },
                fechaInicioUNO: {
                    required: true
                },
                fechaFinUNO: {
                    required: true
                },
                cursoPracticasUNO: {
                    required: true
                },
                tutorPracticasUNO: {
                    required: true
                }
            },
            messages: {
                nombreEstudiante: {
                    required: "Agregar Estudiante, Obligatorio"
                },
                empresaPracticasUNO: {
                    required: "Agregar Empresa Obligatorio",
                },
                horasPracticasUNO: {
                    required: "Establecer Hora, Obligatorio"
                },
                fechaInicioUNO: {
                    required: "Establecer Fecha, obligatorio"
                },
                fechaFinUNO: {
                    required: "Establecer Fecha, obligatorio"
                },
                cicloPracticas: {
                    required: "Ciclo Academico obligatorio"
                },
                cursoPracticas: {
                    required: "Curso obligatorio"
                },
                cursoPracticasUNO: {
                    required: "Tutor obligatorio"
                },
                tutorPracticasUNO: {
                    required: "Tutor obligatorio"
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
                $.post("<?= base_url('/gestion-listadoPracticasDSW') ?>", $("#formDatos").serialize())
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
                            $("#idPracticasDSW").val("");
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
                url: "<?= base_url('/buscar-listadoPracticasDSW'); ?>",
                dataType: 'json',
                data: {
                    idPracticasDSW: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idPracticasDSW").val(v.idPracticasDSW);
                    $('#nombreEstudiante').val(v.Cedula);
                    $('#empresaPracticasUNO').val(v.Empresa);
                    $('#horasPracticasUNO').val(v.Horas);
                    $('#fechaInicioUNO').val(v.Fecha_Inicio);
                    $('#fechaFinUNO').val(v.Fecha_Fin);
                    $('#cursoPracticasUNO').val(v.Curso);
                    $('#carreraPracticas');
                    $('#tutorPracticasUNO').val(v.Tutor_Academico);
                    $('#horasCum1').val(v.Horas_Cum1);
                    $('#terminado').val(v.Terminado);

                    $('#empresaDOS').val(v.Empresa2);
                    $('#horasDOS').val(v.Horas2);
                    $('#fechaInicioDOS').val(v.Fecha_Inicio2);
                    $('#fechaFinDOS').val(v.Fecha_Fin2);
                    $('#cursoPracticasDOS').val(v.Curso2);
                    $('#carreraPracticas');
                    $('#tutorPracticasDOS').val(v.Tutor_Academico2);
                    $('#horasCum2').val(v.Horas_Cum2);
                    $('#terminadoDOS').val(v.Terminado2);

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
        $("#idPracticasDSW").val("");
        $("#modalCenterTitle").text("Listado");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });

    function enviarAprobado(cedula, nombreCompleto, empresa, carrera, fechaInicio, fechaFin, horas, empresa2, fechaInicio2, fechaFin2, horas2) {
        $.ajax({
                type: 'post',
                url: "<?= base_url('aprobado-practicasDesarrollo') ?>",
                dataType: 'json',
                data: {
                    Cedula: cedula,
                    NombreCompleto: nombreCompleto,
                    Empresa: empresa,
                    Carrera: carrera,
                    Fecha_Inicio: fechaInicio,
                    Fecha_fin: fechaFin,
                    Horas: horas,

                    Empresa2: empresa2,
                    Fecha_Inicio2: fechaInicio2,
                    Fecha_fin2: fechaFin2,
                    Horas2: horas2
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