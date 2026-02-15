# gestion-tareas-laravel

Aplicacion desarrollada como parte de una prueba tecnica.

Una API REST construida con Laravel que permite a los usuarios autenticados gestionar sus tareas personales.

## Tecnologia

- Laravel (11+)
- PHP 8+
- MySQL
- Eloquent ORM
- Laravel Sanctum
- API Resources

  ## Caracteristicas

- Registro de usuario
- Inicio de sesion
- Cierre de sesion
- Autenticacion mediante Laravel Sanctum
- CRUD basico de tareas
- Orden por fecha de vencimiento (ascendente por defecto)
- Paginacion
- Validaciones mediante FormRequest
- Notificaciones por correo cuando:
  - Se crea una tarea
  - Se completa

## instalacion

1. Clonar repositorio 
   git clone https://github.com/MiguelAZM/gestion-tareas-laravel.git
   
3.  cd gestion-tareas-laravel
4.  cp .env.example .env
5. Instalar dependencias
   composer install

6. Generar clave
   php artisan key:generate

7. Configurar base de datos en el archivo .env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=gestion_tareas
  DB_USERNAME=root
  DB_PASSWORD=

8. Ejecutar migraciones
   php artisan migrate

9. ejecucion
   php artisan serve
