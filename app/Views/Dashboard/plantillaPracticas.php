<?php
$current_page = basename($_SERVER['PHP_SELF'], ".php");
$active_menu = '';

switch ($current_page) {
    case 'empresas-practicas':
        $active_menu = 'empresas-practicas';
        break;
    case 'estudiantes-practicas':
        $active_menu = 'estudiantes-practicas';
        break;
    case 'curso':
        $active_menu = 'curso';
        break;
    case 'tutor':
        $active_menu = 'tutor';
        break;
    case 'listadoPracticas':
        $active_menu = 'listadoPracticas';
        break;
    case 'matriz-practicas':
        $active_menu = 'matriz-practicas';
        break;
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>ISTVL Practicas </title>
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
                        <a href="<?php echo base_url('practicas'); ?>">
                            <img src="<?php echo base_url('assets/img/favicon/logo_2.png'); ?>" width="200" height="65">
                        </a>
                    </span>
                </div>
                <div class="dropdown-item">
                    <b>
                        <center>PRACTICAS</center>
                    </b>
                </div>
                <div class="dropdown-divider"></div>
                <ul class="menu-inner py-1">
                    <span class="dropdown-item"><b>MENÚ</b></span>
                    <!-- Empresas -->
                    <li class="menu-item <?php echo ($active_menu == 'empresas-practicas') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('empresas-practicas'); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-buildings"></i>
                            <div data-i18n="Empresas">Empresas</div>
                        </a>
                    </li>
                    <!-- Estudiantes -->
                    <li class="menu-item <?php echo ($active_menu == 'estudiantes-practicas') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('estudiantes-practicas'); ?>" class="menu-link ">
                            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                            <div data-i18n="Estudiantes">Estudiantes</div>
                        </a>
                    </li>
                    <!-- Tutores -->
                    <li class="menu-item <?php echo ($active_menu == 'tutor') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('tutor'); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Tutores">Tutores</div>
                        </a>
                    </li>
                    <!-- Cursos -->
                    <li class="menu-item <?php echo ($active_menu == 'curso') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('curso'); ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div data-i18n="Curso">Cursos</div>
                        </a>
                    </li>
                    <!-- Listado -->
                    <li class="menu-item <?php echo ($active_menu == 'listadoPracticas') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('listadoPracticas'); ?>" class="menu-link">
                            <i class="menu-icon bx bx-spreadsheet"></i>
                            <div data-i18n="Listado">Listado</div>
                        </a>
                    </li>
                    <!-- Matriz -->
                    <li class="menu-item <?php echo ($active_menu == 'matriz-practicas') ? 'active open' : ''; ?>">
                        <a href="<?php echo base_url('matriz-practicas'); ?>" class="menu-link">
                            <i class="menu-icon bx bx-task"></i>
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
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                            </div>
                        </div>
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
                                                    <small class="text-muted"><?= session('carreraUsuario'); ?></small>
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