<?php

// Taller Silex - Usuarios
// =======================

/*

*/

// uso del autoload generado por composer
require_once __DIR__.'/vendor/autoload.php';

// uso de las clases Request y Response de Symfony
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Crea la Aplicación
// ==================

$app = new Silex\Application();

// configurar el generador de URLs
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// configura el manejo de sesiones
$app->register(new Silex\Provider\SessionServiceProvider());

// configurar Twig en la Aplicación
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

// Rutas
// =====

// si la ruta termina en "/", cambia la ruta a "/index.php"
if ( substr($_SERVER["REQUEST_URI"], -1) == '/'
     && substr($_SERVER["REQUEST_URI"], -10) != 'index.php/') {
  header("Location: index.php");
  die();
}

// la ruta "/" redirige al formulario de login
$app->get('/', function() use($app) {

  // redirige el navegador a "/login"
  return $app->redirect( $app['url_generator']->generate('login'));

});

// la ruta "/login" muestra el formulario de login
$app->get('/login', function() use($app) {

  // obtiene el nombre de usuario de la sesión
  $user = $app['session']->get('user');

  // ya ingreso un usuario ?
  if ( isset( $user ) && $user != '' ) {
    // redirige el navegador a "/login"
    return $app->redirect( $app['url_generator']->generate('menu'));
  }

  // muestra la plantilla views/login.html.twig
  // usando como valor $user
  return $app['twig']->render('login.html.twig', array(
      'user' => $user
    ));

  // al usar bind define el nombre 'login'
  // en las plantillas es posible incluir un link usando url('login')
  // es posible hacer un redirect usando $app['url_generator']->generate('login')
})->bind('login');


// la ruta "/doLogin" recibe los datos del formulario
// note que se recibe $request como parámetro
$app->post('/doLogin', function(Request $request) use($app) {

  // toma los datos de la petición web
  $login = $request->get('login');
  $password = $request->get('password');

  // coincide el login con el password ?
  if ( $login == $password ) {

    // coloca el nombre del usuario en la sesión
    $app['session']->set('user', $login);
    // redirige el navegador a "/menu"
    return $app->redirect( $app['url_generator']->generate('menu'));

  // no conincide ?
  } else {

    // redirige el navegador a "/login"
    return $app->redirect( $app['url_generator']->generate('login'));
  }

  // hace un bind con el nombre "doLogin"
})->bind('doLogin');

// hace un logout
$app->get('/doLogout', function() use($app){

  // remueve el usuario de la sesión
  $user = $app['session']->set('user', '');

  // redirige el navegador a "/login"
  return $app->redirect( $app['url_generator']->generate('login'));

})->bind('doLogout');


// la ruta "/menu" muestra un menú
$app->get('/menu', function() use($app) {

  // obtiene el nombre de usuario de la sesión
  $user = $app['session']->get('user');

  // ya ingreso un usuario ?
  if ( isset( $user ) && $user != '' ) {
    // muestra la plantilla views/menu.html.twig
    return $app['twig']->render('inicio.html.twig', array(
      'user' => $user
    ));

  } else {
    // redirige el navegador a "/login"
    return $app->redirect( $app['url_generator']->generate('login'));
  }

  // hace un bind con el nombre "menu"
})->bind('menu');

// Agrega las rutas en UsersController
$app->mount('/users', new App\Users\UsersController());

// Corre la Aplicación
// ===================

$app['debug'] = true;
$app->run();