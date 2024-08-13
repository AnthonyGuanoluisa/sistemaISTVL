<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//LOGIN
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->get('logout', 'Login::logout');
$routes->post('validar-ingreso', 'Login::validarIngreso');

//LOGIN ADMIN
//$routes->post('admin/access/(:alpha)', 'Access::adminAccess/$1');
$routes->post('Access/adminAccess/(:alpha)/(:alpha)', 'Access::adminAccess/$1/$2');

//ADMINISTRADOR
$routes->get('administrador', 'Dashboard::administrador');
//Cargos
$routes->get('cargos/(:any)', 'Cargos::index/$1');
$routes->post('lista-cargos', 'Cargos::listarRegistros');
$routes->post('gestion-cargos', 'Cargos::gestionRegistro');
$routes->post('buscar-cargos', 'Cargos::buscarRegistroPorID');
$routes->post('eliminar-cargos', 'Cargos::eliminarRegistro');
//Carreras
$routes->get('carreras/(:any)', 'Carreras::index/$1');
$routes->post('lista-carreras', 'Carreras::listarRegistros');
$routes->post('gestion-carreras', 'Carreras::gestionRegistro');
$routes->post('buscar-carreras', 'Carreras::buscarRegistroPorID');
$routes->post('eliminar-carreras', 'Carreras::eliminarRegistro');
//Cursos
$routes->get('cursos/(:any)', 'Cursos::index/$1');
$routes->post('listado-cursos', 'Cursos::listarRegistros');
$routes->post('gestion-cursos', 'Cursos::gestionRegistro');
$routes->post('buscar-cursos', 'Cursos::buscarRegistroPorID');
$routes->post('eliminar-cursos', 'Cursos::eliminarRegistro');
//Periodos
$routes->post('listado-periodos', 'Periodos::listarRegistros');
$routes->post('gestion-periodos', 'Periodos::gestionRegistro');
$routes->post('buscar-periodos', 'Periodos::buscarRegistroPorID');
$routes->post('eliminar-periodos', 'Periodos::eliminarRegistro');
//Jornadas
$routes->post('listado-jornadas', 'Jornadas::listarRegistros');
$routes->post('gestion-jornadas', 'Jornadas::gestionRegistro');
$routes->post('buscar-jornadas', 'Jornadas::buscarRegistroPorID');
$routes->post('eliminar-jornadas', 'Jornadas::eliminarRegistro');
//Niveles
$routes->post('listado-niveles', 'Niveles::listarRegistros');
$routes->post('gestion-niveles', 'Niveles::gestionRegistro');
$routes->post('buscar-niveles', 'Niveles::buscarRegistroPorID');
$routes->post('eliminar-niveles', 'Niveles::eliminarRegistro');
//Usuarios
$routes->get('usuarios/(:any)', 'usuarios::index/$1');
$routes->post('lista-usuarios', 'usuarios::listarRegistros');
$routes->post('gestion-usuarios', 'usuarios::gestionRegistro');
$routes->post('buscar-usuarios', 'usuarios::buscarRegistroPorID');
$routes->post('eliminar-usuarios', 'usuarios::eliminarRegistro');
$routes->post('buscar-usuarios', 'usuarios::buscarUsuarios');
//Estudiantes
$routes->get('estudiantes/(:any)', 'Estudiantes::index/$1');
$routes->post('lista-estudiantes', 'Estudiantes::listarRegistros');
$routes->post('gestion-estudiantes', 'Estudiantes::gestionRegistro');
$routes->post('buscar-estudiantes', 'Estudiantes::buscarRegistroPorID');
$routes->post('eliminar-estudiantes', 'Estudiantes::eliminarRegistro');
$routes->post('buscar-estudiantes', 'Estudiantes::buscarEstudiantes');
//Estudiantes
$routes->get('asignaciones/(:any)', 'Asignaciones::index/$1');
$routes->post('lista-asignacion', 'Asignaciones::listarRegistros');
$routes->post('gestion-asignacion', 'Asignaciones::gestionRegistro');
$routes->post('buscar-asignacion', 'Asignaciones::buscarRegistroPorID');
$routes->post('eliminar-asignacion', 'Asignaciones::eliminarRegistro');
//Empresas practicas/vinculacion
$routes->get('empresas/(:any)', 'Empresas::index/$1');
$routes->post('lista-empresas', 'Empresas::listarRegistros');
$routes->post('gestion-empresas', 'Empresas::gestionRegistro');
$routes->post('buscar-empresas', 'Empresas::buscarRegistroPorID');
$routes->post('eliminar-empresas', 'Empresas::eliminarRegistro');
$routes->post('buscar-empresas', 'Empresas::buscarEmpresas');
$routes->post('buscar-proyecto-empresa', 'Empresas::buscarProyectos');
$routes->post('buscarEmpresaCarrera', 'Empresas::buscarEmpresaCarreraPracticas');
$routes->post('buscarEmpresaCarreraVin', 'Empresas::buscarEmpresaCarreraVinculacion');
$routes->post('buscarEstudiantesCarrera', 'Estudiantes::buscarEstudianteCarrera');
$routes->post('buscarTutoresCarrera', 'Tutores::buscarTutoresCarrera');
$routes->post('buscarCursoCarrera', 'Cursos::buscarCursosCarrera');
//Proyectos
$routes->get('proyectos/(:any)', 'Proyectos::index/$1');
$routes->post('lista-proyectos', 'Proyectos::listarRegistros');
$routes->post('gestion-proyectos', 'Proyectos::gestionRegistro');
$routes->post('buscar-proyectos', 'Proyectos::buscarRegistroPorID');
$routes->post('eliminar-proyectos', 'Proyectos::eliminarRegistro');
//Listados Vinculacion
$routes->get('listadosVinculacion/(:any)', 'ListadosVinculacion::index/$1');
$routes->post('lista-listadosVinculacion', 'ListadosVinculacion::listarRegistros');
$routes->post('gestion-listadosVinculacion', 'ListadosVinculacion::gestionRegistro');
$routes->post('buscar-listadosVinculacion', 'ListadosVinculacion::buscarRegistroPorID');
$routes->post('eliminar-listadosVinculacion', 'ListadosVinculacion::eliminarRegistro');
//Tutores
$routes->get('tutores/(:any)', 'Tutores::index/$1');
$routes->post('lista-tutores', 'Tutores::listarRegistros');
$routes->post('gestion-tutores', 'Tutores::gestionRegistro');
$routes->post('buscar-tutores', 'Tutores::buscarRegistroPorID');
$routes->post('eliminar-tutores', 'Tutores::eliminarRegistro');
$routes->post('buscar-tutores', 'Tutores::buscarUsuarios');
//Listados Practicas
$routes->get('listadosPracticas/(:any)', 'ListadosPracticas::index/$1');
$routes->post('lista-listadosPracticas', 'ListadosPracticas::listarRegistros');
$routes->post('gestion-listadosPracticas', 'ListadosPracticas::gestionRegistro');
$routes->post('buscar-listadosPracticas', 'ListadosPracticas::buscarRegistroPorID');
$routes->post('eliminar-listadosPracticas', 'ListadosPracticas::eliminarRegistro');

//Listado DSW
$routes->get('listadoPracticasDSW/(:any)', 'ListadoPracticasDSW::index/$1');
$routes->post('lista-listadoPracticasDSW', 'ListadoPracticasDSW::listarRegistros');
$routes->post('gestion-listadoPracticasDSW', 'ListadoPracticasDSW::gestionRegistro');
$routes->post('buscar-listadoPracticasDSW', 'ListadoPracticasDSW::buscarRegistroPorID');
$routes->post('eliminar-listadoPracticasDSW', 'ListadoPracticasDSW::eliminarRegistro');
//Certificados por generar
$routes->get('certificados/(:any)', 'Certificados::index/$1');
$routes->post('lista-certificados', 'Certificados::listarRegistros');
$routes->post('gestion-certificados', 'Certificados::gestionRegistro');
$routes->post('buscar-certificados', 'Certificados::buscarRegistroPorID');
$routes->post('eliminar-certificados', 'Certificados::eliminarRegistro');
$routes->get('generar-certificado/(:num)', 'GenerarCertificado::generarCertificado/$1');
//Certificados DSW
$routes->post('lista-certificadosDSW', 'CertificadosDSW::listarRegistros');
$routes->post('gestion-certificadosDSW', 'CertificadosDSW::gestionRegistro');
$routes->post('buscar-certificadosDSW', 'CertificadosDSW::buscarRegistroPorID');
$routes->post('eliminar-certificadosDSW', 'CertificadosDSW::eliminarRegistro');
$routes->get('generar-certificado/(:num)', 'GenerarCertificado::generarCertificadoDSW/$1');
//Certificados generados
$routes->get('certificados-generados', 'Certificados::indexGenerados');
//Certificados Informacion
$routes->post('lista-informacionCertificados', 'InformacionCertificados::listarRegistros');
$routes->post('gestion-informacionCertificados', 'InformacionCertificados::gestionRegistroInfo');
$routes->post('buscar-informacionCertificados', 'InformacionCertificados::buscarRegistroPorID');
$routes->post('buscar-informacionCertificados', 'InformacionCertificados::buscarUsuarios');
//Matriz
$routes->get('matriz', 'Matrices::index');
$routes->post('lista-matriz', 'Matrices::listarRegistros');
$routes->post('gestion-matriz', 'Matrices::gestionRegistro');
$routes->post('buscar-matriz', 'Matrices::buscarRegistroPorID');
$routes->post('eliminar-matriz', 'Matrices::eliminarRegistro');
$routes->post('buscar-matriz', 'Matrices::buscarMatriz');
//APROBACION PRACTICAS-VINCULACION
$routes->post('aprobado-vinculacion', 'Certificados::enviarAprobadoVinculacion');
$routes->post('aprobado-practicas', 'Certificados::enviarAprobadoPracticas');
$routes->post('aprobado-practicasDesarrollo', 'CertificadosDSW::enviarAprobadoPracticasDSW');
//Comprobar Certificados
$routes->post('aprobado-certificado', 'CertificadosAprobados::enviarCertificadosAprobados');
$routes->post('aprobado-certificadoDSW', 'CertificadosAprobados::enviarCertificadosAprobadosDSW');


//COORDINADOR MENU
$routes->get('coordinador', 'Dashboard::coordinador');
//Estudiantes
$routes->get('coordinador-estudiantes', 'Estudiantes::indexCoordinador');
$routes->post('lista-estudiantes', 'Estudiantes::listarRegistros');
$routes->post('gestion-estudiantes', 'Estudiantes::gestionRegistro');
$routes->post('buscar-estudiantes', 'Estudiantes::buscarRegistroPorID');
$routes->post('eliminar-estudiantes', 'Estudiantes::eliminarRegistro');
$routes->post('buscar-estudiantes', 'Estudiantes::buscarEstudiantes');
//Empresas
$routes->get('coordinador-empresas', 'Empresas::indexCoordinador');
$routes->post('lista-empresas', 'Empresas::listarRegistros');
$routes->post('lista-empresasCoordinador', 'Empresas::listarRegistrosCoordinador');
$routes->post('gestion-empresas', 'Empresas::gestionRegistro');
$routes->post('buscar-empresas', 'Empresas::buscarRegistroPorID');
$routes->post('eliminar-empresas', 'Empresas::eliminarRegistro');
//Certificados por generar
$routes->get('certificado', 'Certificados::indexCoordinador');
$routes->get('certificados/(:any)', 'Certificados::index/$1');
$routes->post('lista-certificados', 'Certificados::listarRegistros');
$routes->post('gestion-certificados', 'Certificados::gestionRegistro');
$routes->post('buscar-certificados', 'Certificados::buscarRegistroPorID');
$routes->post('eliminar-certificados', 'Certificados::eliminarRegistro');
$routes->get('generar-certificado/(:num)', 'GenerarCertificado::generarCertificado/$1');
//Certificados DSW
$routes->post('lista-certificadosDSW', 'CertificadosDSW::listarRegistros');
$routes->post('gestion-certificadosDSW', 'CertificadosDSW::gestionRegistro');
$routes->post('buscar-certificadosDSW', 'CertificadosDSW::buscarRegistroPorID');
$routes->post('eliminar-certificadosDSW', 'CertificadosDSW::eliminarRegistro');
$routes->get('generar-certificadosDSW/(:num)', 'GenerarCertificado::generarCertificadoDSW/$1');
//Certificados generados
$routes->get('certificado-generado', 'Certificados::indexGenerado');
//Certificados Informacion
$routes->post('lista-informacionCertificados', 'InformacionCertificados::listarRegistros');
$routes->post('gestion-informacionCertificados', 'InformacionCertificados::gestionRegistroInfo');
$routes->post('buscar-informacionCertificados', 'InformacionCertificados::buscarRegistroPorID');
$routes->post('buscar-informacionCertificados', 'InformacionCertificados::buscarUsuarios');
//Matriz
$routes->get('coordinador-matriz', 'Matrices::indexCoordinador');
$routes->post('lista-matriz', 'Matrices::listarRegistros');
$routes->post('gestion-matriz', 'Matrices::gestionRegistro');
$routes->post('buscar-matriz', 'Matrices::buscarRegistroPorID');
$routes->post('eliminar-matriz', 'Matrices::eliminarRegistro');
$routes->post('buscar-matriz', 'Matrices::buscarMatriz');

//VINCULACION MENU
$routes->get('vinculacion', 'Dashboard::vinculacion');
//Empresas
$routes->get('empresas-vinculacion', 'Empresas::indexVinculacion');
$routes->post('lista-empresas-asignacion', 'Empresas::listarRegistrosAsignacion');
$routes->post('gestion-empresas-asignacion', 'Empresas::gestionRegistro');
$routes->post('buscar-empresas-asignacion', 'Empresas::buscarRegistroPorID');
$routes->post('eliminar-empresas-asignacion', 'Empresas::eliminarRegistro');
$routes->post('buscar-empresas-asignacion', 'Empresas::buscarEmpresas');
//Estudiantes
$routes->get('estudiantes-vinculacion', 'Estudiantes::indexVinculacion');
$routes->post('lista-estudiantes-asignacion', 'Estudiantes::listarRegistrosAsignacion');
$routes->post('gestion-estudiantes-asignacion', 'Estudiantes::gestionRegistro');
$routes->post('buscar-estudiantes-asignacion', 'Estudiantes::buscarRegistroPorID');
$routes->post('eliminar-estudiantes-asignacion', 'Estudiantes::eliminarRegistro');
$routes->post('buscar-estudiantes-asignacion', 'Estudiantes::buscarEstudiantes');
//Proyectos
$routes->get('proyecto', 'Proyectos::indexVinculacion');
$routes->post('lista-proyecto', 'Proyectos::listarRegistro');
$routes->post('gestion-proyectos', 'Proyectos::gestionRegistro');
$routes->post('buscar-proyectos', 'Proyectos::buscarRegistroPorID');
$routes->post('eliminar-proyectos', 'Proyectos::eliminarRegistro');
//Listado
$routes->get('listadoVinculacion', 'ListadosVinculacion::indexVinculacion');
$routes->post('lista-listadoVinculacion', 'ListadosVinculacion::listarRegistro');
$routes->post('gestion-listadoVinculacion', 'ListadosVinculacion::gestionRegistro');
$routes->post('buscar-listadoVinculacion', 'ListadosVinculacion::buscarRegistroPorID');
$routes->post('eliminar-listadoVinculacion', 'ListadosVinculacion::eliminarRegistro');
//Matriz
$routes->get('matriz-vinculacion', 'Matrices::indexVinculacion');
$routes->post('lista-matriz-asignacion', 'Matrices::listarRegistrosAsignacion');

//PRACTICAS
$routes->get('practicas', 'Dashboard::practicas');
//Empresas
$routes->get('empresas-practicas', 'Empresas::indexPracticas');
$routes->post('lista-empresas-asignacion', 'Empresas::listarRegistrosAsignacion');
$routes->post('gestion-empresas-asignacion', 'Empresas::gestionRegistro');
$routes->post('buscar-empresas-asignacion', 'Empresas::buscarRegistroPorID');
$routes->post('eliminar-empresas', 'Empresas::eliminarRegistro');
$routes->post('buscar-empresas', 'Empresas::buscarEmpresas');
$routes->post('buscarProyectoEmpresa', 'Proyectos::buscarRegistroID');
//Estudiantes
$routes->get('estudiantes-practicas', 'Estudiantes::indexPracticas');
$routes->post('lista-estudiantes-asignacion', 'Estudiantes::listarRegistrosAsignacion');
$routes->post('gestion-estudiantes-asignacion', 'Estudiantes::gestionRegistro');
$routes->post('buscar-estudiantes-asignacion', 'Estudiantes::buscarRegistroPorID');
$routes->post('eliminar-estudiantes-asignacion', 'Estudiantes::eliminarRegistro');
$routes->post('buscar-estudiantes-asignacion', 'Estudiantes::buscarEstudiantes');
//Tutores
$routes->get('tutor', 'Tutores::indexPracticas');
$routes->post('lista-tutor', 'Tutores::listarRegistro');
$routes->post('gestion-tutores', 'Tutores::gestionRegistro');
$routes->post('buscar-tutores', 'Tutores::buscarRegistroPorID');
$routes->post('eliminar-tutores', 'Tutores::eliminarRegistro');
$routes->post('buscar-tutores', 'Tutores::buscarUsuarios');
//CURSOS
$routes->get('curso', 'Cursos::indexPracticas');
$routes->post('listado-curso', 'Cursos::listarRegistro');
$routes->post('gestion-cursos', 'Cursos::gestionRegistro');
$routes->post('buscar-cursos', 'Cursos::buscarRegistroPorID');
$routes->post('eliminar-cursos', 'Cursos::eliminarRegistro');
//Listado
$routes->get('listadoPracticas', 'ListadosPracticas::indexPracticas');
$routes->post('lista-listadoPracticas', 'ListadosPracticas::listarRegistro');
$routes->post('gestion-listadosPracticas', 'ListadosPracticas::gestionRegistro');
$routes->post('buscar-listadosPracticas', 'ListadosPracticas::buscarRegistroPorID');
$routes->post('eliminar-listadosPracticas', 'ListadosPracticas::eliminarRegistro');
//LISTADO DE PRACTICAS DSW
$routes->get('ListadoPracticasDSW', 'ListadoPracticasDSW::indexPracticas');
$routes->post('lista-listadoPracticasDSW', 'ListadoPracticasDSW::listarRegistros');
$routes->post('gestion-listadoPracticasDSW', 'ListadoPracticasDSW::gestionRegistro');
$routes->post('buscar-listadoPracticasDSW', 'ListadoPracticasDSW::buscarRegistroPorID');
$routes->post('eliminar-listadoPracticasDSW', 'ListadoPracticasDSW::eliminarRegistro');
//Matriz
$routes->get('matriz-practicas', 'Matrices::indexPracticas');
$routes->post('lista-matriz-practicas', 'Matrices::listarRegistrosAsignacion');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
