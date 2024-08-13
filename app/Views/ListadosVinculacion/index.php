<?= $this->extend('Views/Dashboard/plantillaAdmin'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/spinner.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Administrador / Listado Vinculacion /</span> Listado</h4>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
            <i class="tf-icons bx bx-plus"></i> Agregar
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-lg-4 col-md-6">
                <div class="mt-3">
                    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Listado-Vinculación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form class="modal-body" id="formDatos" method="post">
                                    <input type="hidden" name="idVinculacion" id="idVinculacion" value="" />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col mb-2">
                                                <label for="carreraEmpresa" class="form-label">Carrera</label>
                                                <select name="carreraEmpresa" id="carreraEmpresa" class="form-select" onchange="cargarEmpresasPorCarreras(this.value),cargarEstudiantesPorCarreras(this.value)">
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
                                            <div class="col mb-2">
                                                <label for="empresaVinc" class="form-label">Empresas</label>
                                                <select name="empresaVinc" id="empresaVinc" class="form-select" onchange="cargarProyectosPorEmpresa(this.value);">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="proyectosVin" class="form-label">Proyecto</label>
                                                <select name="proyectosVin" id="proyectosVin" class="form-select">
                                                    <option value="">SELECCIONE...</option>
                                                </select>
                                            </div>
                                            <div class="col mb-2">
                                                <label for="horasVin" class="form-label">Horas</label>
                                                <input type="text" name="horasVin" id="horasVin" class="form-control" />
                                            </div>
                                        </div>
                                        <?php
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col mb-0">
                                                    <label for="nombreEstudiante" class="form-label">Estudiante</label>
                                                    <select name="nombreEstudiante" id="nombreEstudiante" class="form-select">
                                                        <option value="">SELECCIONE...</option>
                                                    </select>
                                                </div>
                                                <div class="col mb-2">
                                                    <label for="cicloVin" class="form-label">Ciclo</label>
                                                    <select name="cicloVin" id="cicloVin" class="form-select">
                                                        <?php if ($ciclo) { ?>
                                                            <option value="">SELECCIONE...</option>
                                                            <?php foreach ($ciclo as $dp) { ?>
                                                                <option value="<?= $dp->tipoCiclo; ?>"><?= $dp->tipoCiclo; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
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
                                                    <label for="aprobadoVin" class="form-label">Aprobado</label>
                                                    <select name="aprobadoVin" id="aprobadoVin" class="form-select" onchange="cambiarEstado()">
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
        localStorage.removeItem('horasCulminacion');
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
            var horasVin = parseInt(document.getElementById('horasVin').value);
            var horasCulminacion = parseInt(document.getElementById('horasCulminacion').value);
            var aprobadoVin = document.getElementById('aprobadoVin');
            var formGroup = document.getElementById('formGroup');

            if (horasCulminacion < horasVin) {
                document.getElementById('horasCulminacion').style.borderColor = "red";
                document.getElementById('formGroup').style.borderColor = "red";
                aprobadoVin.value = "NO";
            } else {
                document.getElementById('horasCulminacion').style.borderColor = ""; // Restaurar el color del borde
                if (horasCulminacion === horasVin) {
                    aprobadoVin.value = "SI";
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
        $("#listadoDatos").load("<?= base_url('/lista-listadosVinculacion'); ?>", {
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
                $("#idVinculacion").val("");
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
                                url: "<?= base_url('/eliminar-listadosVinculacion'); ?>",
                                dataType: 'json',
                                data: {
                                    idVinculacion: $(aObject).data('id')
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
                Swal.fire("Información!", "Opción desconocida", "info");
                break;
        }
    }

    $(document).ready(function() {
        $('#formDatos').validate({
            rules: {
                nombreEstudiante: {
                    required: true
                },
                empresaVinc: {
                    required: true
                },
                horasVin: {
                    required: true
                },
                carreraEmpresa: {
                    required: true
                },
                fechaInicio: {
                    required: true
                },
                fechaFin: {
                    required: true
                },
                cursoVin: {
                    required: true
                },
                proyectosVin: {
                    required: true
                }
            },
            messages: {
                nombreEstudiante: {
                    required: "Agregar Estudiante, Obligatorio"
                },
                empresaVinc: {
                    required: "Agregar Empresa Obligatorio",
                },
                horasVin: {
                    required: "Establecer Hora, Obligatorio"
                },
                carreraEmpresa: {
                    required: "Carrera obligatorio"
                },
                fechaInicio: {
                    required: "Establecer Fecha, obligatorio"
                },
                fechaFin: {
                    required: "Establecer Fecha, obligatorio"
                },
                cursoVin: {
                    required: "Curso obligatorio"
                },
                proyectosVin: {
                    required: "Proyecto obligatorio"
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
                $.post("<?= base_url('/gestion-listadosVinculacion') ?>", $("#formDatos").serialize())
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
                                    Swal.fire("Información!", "El estudiante ya se encuentra realizando Vinculación", "info");
                                    break;
                            }
                            $("#formDatos")[0].reset();
                            $("#idVinculacion").val("");
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
                url: "<?= base_url('/buscar-listadosVinculacion'); ?>",
                dataType: 'json',
                data: {
                    idVinculacion: id
                }
            })
            .done(function(data) {
                $(data).each(function(i, v) {
                    $("#idVinculacion").val(v.idVinculacion);
                    $('#nombreEstudiante').val(v.Cedula);
                    $('#empresaVinc').val(v.Empresa);
                    $('#horasVin').val(v.Horas);
                    $('#fechaInicio').val(v.Fecha_Inicio);
                    $('#fechaFin').val(v.Fecha_Fin);
                    $('#carreraEmpresa').val(v.Carrera);
                    $('#horasCulminacion').val(v.Total_Horas);
                    $('#aprobadoVin').val(v.Aprobado);
                    $('#cicloVin').val(v.Periodo);

                    Promise.all([
                        cargarEmpresasPorCarreras(v.Carrera),
                        cargarEstudiantesPorCarreras(v.Carrera),
                        cargarProyectosPorEmpresa(v.Empresa)
                    ]).then(() => {
                        $('#empresaVinc').val(v.Empresa);
                        $('#nombreEstudiante').val(v.Cedula);
                        $('#proyectosVin').val(v.Proyecto);
                    }).catch((error) => {
                        console.error('Error al cargar los datos relacionados:', error);
                    }).finally(() => {
                        hideSpinner();
                    });
                });
            })
            .fail(function() {
                Swal.fire("Error!", "No se pudieron cargar los datos", "error");
                hideSpinner();
            });
    }

    $('#exLargeModal').on('hidden.bs.modal', function() {
        $("#formDatos")[0].reset();
        $("#idVinculacion").val("");
        $("#modalCenterTitle").text("Listado");
        $("#formDatos").find('.error').removeClass("error");
        $("#formDatos").find('.success').removeClass("success");
        $("#formDatos").find('.valid').removeClass("valid");
    });


    function cargarEmpresasPorCarreras(id) {
        return new Promise((resolve, reject) => {
            console.log('ID de la carrera seleccionada:', id);
            if (id > 0) {
                $.ajax({
                        type: 'post',
                        url: "<?= base_url('/buscarEmpresaCarreraVin'); ?>",
                        dataType: 'json',
                        data: {
                            carreraEmpresa: id
                        }
                    })
                    .done(function(data, textStatus, xhr) {
                        try {
                            $('#empresaVinc').empty();
                            $('#empresaVinc').append('<option value="">SELECCIONE...</option>');

                            if (data.length > 0) {
                                $.each(data, function(index, empresa) {
                                    $('#empresaVinc').append('<option value="' + empresa.idEmpresa + '">' + empresa.nombreEmpresa + '</option>');
                                });
                            } else {
                                $('#empresaVinc').append('<option value="">No hay empresas para esta carrera</option>');
                            }
                            resolve();
                        } catch (e) {
                            console.error('Error al cargar las empresas:', e);
                            reject(e);
                        }
                    })
                    .fail(function(xhr, textStatus, errorThrown) {
                        console.error('Error al cargar las empresas:', errorThrown);
                        reject(errorThrown);
                    });
            } else {
                resolve();
            }
        });
    }

    function cargarEstudiantesPorCarreras(id) {
        return new Promise((resolve, reject) => {
            console.log('ID de la carrera seleccionada:', id);
            if (id > 0) {
                $.ajax({
                        type: 'post',
                        url: "<?= base_url('/buscarEstudiantesCarrera'); ?>",
                        dataType: 'json',
                        data: {
                            carreraEstudiante: id
                        }
                    })
                    .done(function(data) {
                        try {
                            $('#nombreEstudiante').empty();
                            if (data.length > 0) {
                                $.each(data, function(index, estudiante) {
                                    $('#nombreEstudiante').append('<option value="' + estudiante.id + '">' + estudiante.NombreCompleto + '</option>');
                                });
                            } else {
                                $('#nombreEstudiante').append('<option value="">No hay estudiantes para esta carrera</option>');
                            }
                            resolve();
                        } catch (e) {
                            console.error('Error al cargar los estudiantes:', e);
                            reject(e);
                        }
                    })
                    .fail(function(xhr, textStatus, errorThrown) {
                        console.error('Error al cargar los estudiantes:', errorThrown);
                        reject(errorThrown);
                    });
            } else {
                resolve();
            }
        });
    }



    function cargarProyectosPorEmpresa(id) {
        return new Promise((resolve, reject) => {
            console.log('ID de la empresa seleccionada:', id);
            if (id > 0) {
                $.ajax({
                        type: 'post',
                        url: "<?= base_url('/buscarProyectoEmpresa'); ?>",
                        dataType: 'json',
                        data: {
                            empresaProyecto: id
                        }
                    })
                    .done(function(data, textStatus, xhr) {
                        try {
                            $('#proyectosVin').empty();
                            $('#proyectosVin').append('<option value="">SELECCIONE...</option>');

                            if (data.length > 0) {
                                $.each(data, function(index, proyecto) {
                                    $('#proyectosVin').append('<option value="' + proyecto.idProyecto + '">' + proyecto.nombreProyecto + '</option>');
                                });
                            } else {
                                $('#proyectosVin').append('<option value="">No hay proyectos para esta empresa</option>');
                            }
                            resolve();
                        } catch (e) {
                            console.error('Error al cargar los proyectos:', e);
                            reject(e);
                        }
                    })
                    .fail(function(xhr, textStatus, errorThrown) {
                        console.error('Error al cargar los proyectos:', errorThrown);
                        reject(errorThrown);
                    });
            } else {
                resolve();
            }
        });
    }


    function enviarAprobado(cedula, nombreCompleto, empresa, carrera, fechaInicio, fechaFin, horas) {
        $.ajax({
                type: 'post',
                url: "<?= base_url('aprobado-vinculacion') ?>",
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