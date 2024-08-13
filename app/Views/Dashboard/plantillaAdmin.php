<?php
$current_page = basename($_SERVER['PHP_SELF'], ".php");
$active_menu = '';
$active_submenu = '';

switch ($current_page) {
    case 'cargos':
        $active_menu = 'cargos';
        break;
    case 'cursos':
        $active_menu = 'cursos';
        break;
    case 'usuarios':
        $active_menu = 'usuarios';
        break;
    case 'carreras':
        $active_menu = 'carreras';
        break;
    case 'estudiantes':
        $active_menu = 'estudiantes';
        break;
    case 'asignaciones':
        $active_menu = 'asignacionEmpresa';
        $active_submenu = 'asignaciones';
        break;
    case 'empresas':
        $active_menu = 'asignacionEmpresa';
        $active_submenu = 'empresas';
        break;
    case 'proyectos':
        $active_menu = 'listadoVin';
        $active_submenu = 'proyectos';
        break;
    case 'listadosVinculacion':
        $active_menu = 'listadoVin';
        $active_submenu = 'listadosVinculacion';
        break;
    case 'tutores':
        $active_menu = 'listadoPrac';
        $active_submenu = 'tutores';
        break;
    case 'listadosPracticas':
        $active_menu = 'listadoPrac';
        $active_submenu = 'listadosPracticas';
        break;
    case 'listadoPracticasDSW':
        $active_menu = 'listadoPrac';
        $active_submenu = 'listadoPracticasDSW';
        break;
    case 'certificados':
        $active_menu = 'certificados';
        $active_submenu = 'por_generar';
        break;
    case 'certificados-generados':
        $active_menu = 'certificados';
        $active_submenu = 'generados';
        break;
    case 'matriz':
        $active_menu = 'matriz';
        break;
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>ISTVL Practicas y Vinculacion</title>
    <meta name="description" content="" />
    <!-- jquery-validation -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon/logo.png'); ?>" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/boxicons.css'); ?>" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css'); ?>" />
    <script src="<?= base_url('assets/sweet-alert-2/sweetalert2.all.min.js'); ?>"></script>
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/apex-charts/apex-charts.css'); ?>" />
    <!-- Helpers -->
    <script src="<?php echo base_url('assets/vendor/js/helpers.js'); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url('assets/js/config.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Exportar informcion-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>" defer></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js" defer></script>
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
    <!-- PDFMake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" defer></script>
    <!-- Buttons HTML5 export JS -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" defer></script>
    <!-- Buttons print JS -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" defer></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <a href="<?php echo base_url('administrador'); ?>">
                            <img src="<?php echo base_url('assets/img/favicon/logo_2.png'); ?>" width="200" height="65">
                        </a>
                    </span>
                </div>
                <span class="dropdown-item">
                    <b>
                        <center>ADMINISTRADOR</center>
                    </b>
                </span>
                <div class="dropdown-divider"></div>
                <ul class="menu-inner py-1">
                    <span class="dropdown-item"><b>MENÚ</b></span>
                    <!-- Cargos -->
                    <li class="menu-item <?php echo ($active_menu == 'cargos') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('cargos'); ?>" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-list-ul'></i>
                            <div data-i18n="Cargos">Cargos</div>
                        </a>
                    </li>
                    <!-- Carreras -->
                    <li class="menu-item <?php echo ($active_menu == 'carreras') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('carreras'); ?>" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-list-plus'></i>
                            <div data-i18n="Carreras">Carreras</div>
                        </a>
                    </li>
                    <!-- Cursos -->
                    <li class="menu-item <?php echo ($active_menu == 'cursos') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('cursos'); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div data-i18n="Cursos">Cursos</div>
                        </a>
                    </li>
                    <!-- Usuarios -->
                    <li class="menu-item <?php echo ($active_menu == 'usuarios') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('usuarios'); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user me-2"></i>
                            <div data-i18n="usuarios">Usuarios</div>
                        </a>
                    </li>
                    <!-- Estudiantes -->
                    <li class="menu-item <?php echo ($active_menu == 'estudiantes') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('estudiantes'); ?>" class="menu-link ">
                            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                            <div data-i18n="Estudiantes">Estudiantes</div>
                        </a>
                    </li>
                    <!-- Asignacion Empresas -->
                    <li class="menu-item <?php echo ($active_menu == 'asignacionEmpresa') ? 'active open' : ''; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-buildings"></i>
                            <div data-i18n="asignacionEmpresa">Empresas</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo ($active_submenu == 'asignaciones') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('asignaciones'); ?>" class="menu-link">
                                    <div data-i18n="asignacion">Asignacion</div>
                                </a>
                            </li>
                            <li class="menu-item <?php echo ($active_submenu == 'empresas') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('empresas'); ?>" class="menu-link">
                                    <div data-i18n="empresas">Lista </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Listado Vinculacion -->
                    <li class="menu-item <?php echo ($active_menu == 'listadoVin') ? 'active open' : ''; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-receipt"></i>
                            <div data-i18n="listadoVin">Listado Vinculacion</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo ($active_submenu == 'proyectos') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('proyectos'); ?>" class="menu-link">
                                    <div data-i18n="proyectos">Proyectos</div>
                                </a>
                            </li>
                            <li class="menu-item <?php echo ($active_submenu == 'listadosVinculacion') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('listadosVinculacion'); ?>" class="menu-link">
                                    <div data-i18n="listadosVinculacion">Listado</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Listado Practicas -->
                    <li class="menu-item <?php echo ($active_menu == 'listadoPrac') ? 'active open' : ''; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-receipt"></i>
                            <div data-i18n="listadoPrac">Listado Practicas</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo ($active_submenu == 'tutores') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('tutores'); ?>" class="menu-link">
                                    <div data-i18n="tutores">Tutores</div>
                                </a>
                            </li>
                            <li class="menu-item <?php echo ($active_submenu == 'listadosPracticas') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('listadosPracticas'); ?>" class="menu-link">
                                    <div data-i18n="listadosPracticas">Listado</div>
                                </a>
                            </li>
                            <li class="menu-item <?php echo ($active_submenu == 'listadoPracticasDSW') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('listadoPracticasDSW'); ?>" class="menu-link">
                                    <div data-i18n="listadoPracticasDSW">Listado DSW</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Certificados -->
                    <li class="menu-item <?php echo ($active_menu == 'certificados') ? 'active open' : ''; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-spreadsheet" ></i>
                            <div data-i18n="certificados">Certificados</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php echo ($active_submenu == 'por_generar') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('certificados'); ?>" class="menu-link">
                                    <div data-i18n="por_generar">Por Generar</div>
                                </a>
                            </li>
                            <li class="menu-item <?php echo ($active_submenu == 'generados') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('certificados-generados'); ?>" class="menu-link">
                                    <div data-i18n="generados">Generados</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Matriz -->
                    <li class="menu-item <?php echo ($active_menu == 'matriz') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('matriz'); ?>" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-grid'></i>
                            <div data-i18n="Matriz">Matriz</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <span class="fw-semibold d-block"><?= session('nombreUsuario'); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?= session('cargoUsuario'); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="logout();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <?= $this->renderSection('contenido'); ?>
                    <!-- / Content -->
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Vicente Leon</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js/menu.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables.net.extensions/select/select.min.js'); ?>"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="<?php echo base_url('assets/vendor/libs/apex-charts/apexcharts.js'); ?>"></script>
    <!-- Main JS -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <!-- Page JS -->
    <script src="<?php echo base_url('assets/js/dashboards-analytics.js'); ?>"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        function saveComment() {
            var comment = document.getElementById('comment').value;
            localStorage.setItem('userComment', comment);
        }
    </script>
    <script>
        function logout() {
            Swal.fire({
                title: 'Deseas cerrar el sistema?',
                text: "La sesión terminará!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "logout";
                }
            })
        }
    </script>
</body>

</html>