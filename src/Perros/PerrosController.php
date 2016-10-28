<?php

namespace App\Perros;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PerrosController implements ControllerProviderInterface{
  public function connect(Application $app){
    $controller = $app['controllers_factory'];
    $controller->get('/list', function() use($app) {

      $user = $app['session']->get('user');
      $perros = $app['session']->get('perros');
      // ya ingreso un usuario ?
      if ( isset( $user ) && $user != '' ) {
        // muestra la plantilla
        return $app['twig']->render('Perros/perros.list.html.twig', array(
          'user' => $user,
          'perros' => $perros
        ));

      } else {
        // redirige el navegador a "/login"
        return $app->redirect( $app['url_generator']->generate('login'));
      }

    // hace un bind
    })->bind('perros-list');

    return $controller;

  }
}