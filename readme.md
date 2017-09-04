## Codizer Data

Aplicación Web basada en Laravel para la gestion de datos estadisticos.

Codizer Data, es un proyecto desarrollado en la Universidad por un grupo de amigos en el año 2015, este proyecto tiene como objetivo cargar y analizar información especifica mediante graficas.

**Cálculo de medidas:**
* Tendencia central
* Dispersión
* Posición
* Deformación
* Correlación
* Regresión


Actualmente Codizer Data no esta terminado y posiblemente presente anomalias en su código fuente, por ende, se recomienda no usarlo en un ambiente productivo.

**Eres libre de usar y/o distribuir este producto.**

### ¿Cómo instalar?

   * Descargar proyecto dentro de un directorio especifico
   * Entrar al directorio del proyecto desde el Explorador de Archivos/Finder

        - Copiar archivo **.env.example** y renombrar a **.env**
        - Crear una Base de Datos en MySQL
        - Agregar la configuración de la conexión de la BD al archivo **.env**

    
   * Entrar al directorio del proyecto desde Consola/Terminal
        - Instalar dependencias `composer install`
        - Generar clave del proyecto  `php artisan key:generate `
        - Crear tablas con registros en la BD con el comando  `php artisan migrate --seed `
    
   * Iniciar proyecto


### Vistanos en
[Codizer Dev](http://codizer.com)


## Imagenes
![Codizer Data Login](http://codizer.com/git-hub-img/codizer-data-04.png)

![Codizer Data Collections](http://codizer.com/git-hub-img/codizer-data-05.png)

![Codizer Data Collections](http://codizer.com/git-hub-img/codizer-data-02.png)


## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)