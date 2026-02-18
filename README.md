# gestion-tareas-laravel

Aplicacion desarrollada como parte de una prueba tecnica.

Una API REST construida con Laravel que permite a los usuarios autenticados gestionar sus tareas personales.

## Tecnologia

- [Laravel 11](https://laravel.com/) – Framework PHP
- [Sanctum](https://laravel.com/docs/10.x/sanctum) – Autenticación con tokens
- [MySQL](https://www.mysql.com/) – Base de datos
- [Composer](https://getcomposer.org/) – Gestión de dependencias
- [Artisan](https://laravel.com/docs/10.x/artisan) – CLI para Laravel


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
    
##  Estructura principal
├─ Http/Controllers/ Api │   └─ TaskController.php   # Controlador CRUD de tareas| AuthController.php # controlador de autenticacion | Request └─ StoreTaskRequest.php # crear tareas | UpdateTaskRequest.php # actualizar tareas
app/ ├─ Models/Task.php          # Modelo de Tarea | Notifications └─ TaskCompletedNotification.php #correo cuando completa tarea ─ TaskCreateNotification.php -#correo cuando completa tarea
routes/ └─ api.php                  # Definición de rutas de la API
database/ ├─ migrations/ │   └─ create_tasks_table.php   # Migración de tabla tareas | add_justification_to_task_table.php


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

Autenticación
- POST /login → Iniciar sesión
- POST /logout → Cerrar sesión
- POST /register → Registrar usuario
Tareas
- GET /tasks → Listar todas las tareas
- POST /tasks → Crear tarea
Body: { "title": "...", "description": "...", "expiration_date": "YYYY-MM-DD" }
- PUT /tasks/{id} → Actualizar tarea
- DELETE /tasks/{id} → Eliminar tarea
- PATCH /tasks/{id}/complete → Completar tarea con justificación
Body: { "justification": "..." }



