<?php

// Configuración de la aplicación
// ==============================

// uso del autoload generado por composer
require_once __DIR__.'/../vendor/autoload.php';

// Crea la Aplicación
// ==================

$app = new Silex\Application();

// Configura los servicios de Silex
// ================================

// configurar el generador de URLs
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// configura el manejo de sesiones
$app->register(new Silex\Provider\SessionServiceProvider());

// configurar Twig en la Aplicación
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

// retorna la aplicación
return $app;