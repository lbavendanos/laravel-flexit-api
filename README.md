# LARAVEL FLEX IT API
API para el el sistema de Logueo, desarrollado en Laravel 5.4.

Plugins utilizados:
* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

## Instalación

1. Ejecutuar `composer create-project lbavendanos/laravel-flexit-api flexit-api`;
2. Una vez completado el proceso de creación del proyecto, ejecute el comando `php artisan migrate` para instalar las tablas requeridas.

### Rutas Auth: Libres
| Verbo				| URI						| Acción
 ------------------ | --------------------------| ------------------
| POST				| /api/auth/login			| Realiza login y devuelve su token de acceso
| POST				| /api/auth/register		| Crea un nuevo usuario en su aplicación y devuelve un token de acceso
| POST				| /api/auth/recovery		| Recupera password
| POST				| /api/auth/reset			| Restablecer contraseña y devuelve su token de acceso

### Rutas Acceso: Protegidas
| Verbo				| URI						| Acción
 ------------------ | --------------------------| ------------------
| GET				| /api/					    | Obtener mensaje de bienvenida
| GET				| /api/user					| Obtener datos del usuario

## Live

* Backend - [Laravel/FlexIT-API](https://ruta.com/)
* FrondEnd - [Angular/FlexIT](https://ruta.com/)