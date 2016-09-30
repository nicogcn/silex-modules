<?php

namespace App\Users;

use Silex\Application;
use Silex\ControllerProviderInterface;

class UsersController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controller = $app['controllers_factory'];

        // la ruta "/users/list"
        $controller->get('/list', function() use($app) {

          // obtiene el nombre de usuario de la sesión
          $user = $app['session']->get('user');

          // ya ingreso un usuario ?
          if ( isset( $user ) && $user != '' ) {
            // muestra la plantilla
            return $app['twig']->render('users.list.html.twig', array(
              'user' => $user
            ));

          } else {
            // redirige el navegador a "/login"
            return $app->redirect( $app['url_generator']->generate('login'));
          }

        // hace un bind
        })->bind('users-list');

        // la ruta "/users/edit"
        $controller->get('/edit', function() use($app) {

          // obtiene el nombre de usuario de la sesión
          $user = $app['session']->get('user');

          // ya ingreso un usuario ?
          if ( isset( $user ) && $user != '' ) {
            // muestra la plantilla
            return $app['twig']->render('users.edit.html.twig', array(
              'user' => $user
            ));

          } else {
            // redirige el navegador a "/login"
            return $app->redirect( $app['url_generator']->generate('login'));
          }

        // hace un bind
        })->bind('users-edit');

        return $controller;
    }
}