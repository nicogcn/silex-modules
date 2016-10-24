#  Taller Silex - Aplicación

1. Revise la aplicación

  - Este ejemplo extiende el ejemplo anterior
  - Usa varios controladores, uno por cada módulo
    - Cada módulo define sus propias rutas en una clase aparte

2. Responda las siguientes preguntas

  - En el archivo `composer.json`: ¿Cómo se definen las rutas de las clases?
    - En la sección `autoload.classes`
    - En la sección `autoload.psr-4`
    - En la sección `class-loader`

  - En el archivo `app/app.php`: ¿Qué servicios Silex se configuran?
    - ninguno
    - los servicios de `UrlGenerator`,  `Session` y `Twig`
    - los servicios de `Silex` y `Twig`

  - En el archivo `index.php`: ¿Cómo se obtiene la instancia de Application?
    - Se ejecuta un `new Silex\Application()`
    - Se hace un `require` al archivo `app/app.php`
    - Se hace un `require` a `silex/application.php`

  - En el archivo `index.php`: ¿Cómo se cargan los controladores?
    - usando el método `$app->load()`
    - usando el método `$app->module()`
    - usando el método `$app->mount()`

  - En el archivo `src/Login/LoginController.php`: ¿Cómo se definen las rutas?
    - usando el método `$app->addPath()`
    - definiendo un método `connect(Application $app)`
    - haciendo `require` al archivo `rutas.php`

3. Modifique el proyecto de forma que se puedan crear, editar y borrar los datos de los usuarios

   - En la actualidad, el proyecto 
     - permite visualizar un formulario para editar / crear un usuario
     - permite visualizar un listado de usuarios
   - Sin embargo, no permite agregar, editar o eliminar los datos