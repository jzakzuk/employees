# Requerimientos
* Version de laravel = 8
* Php version 8.
* Base de datos .sqlite
* Composer instalado

# Instrucciones

Después de descargar o clonar el repositorio y estar dentro de la carpeta raiz del proyecto ejecutar los siguientes comandos:
1)  **composer install**
El anterior comando es para instalar las dependencias del proyecto
2) **cp .env.example .env**
El comando anterior es para crear el archivo .env 
3) **php artisan key:generate**
El anterior comando genera la clave de la aplicacion de laravel

## Agregar configuracion de base de datos

Abrir el archivo llamado **.env** y colocar valores a las variables de la base de datos

* DB_CONNECTION=sqlite
* DB_HOST=127.0.0.1
* DB_PORT=3306

Las siguientes variables pueden ser borradas del .env
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

## Migracion y datos por defecto

1) Ubicarse en la raiz del proyecto y crear en la carpeta **database** un archivo llamado **database.sqlite**
2) Despues de haber ocnfigurado el archivo **.env** se debe ejecutar la migracion para crear las tablas de la base de datos con el siguietne comando:
**php artisan migrate**

3) Crear usuario y otros datos por defecto. Ejecutar el siguiente comando:
**php artisan db:seed --class=DatabaseSeeder**
El anterior comando creará en la base de datos, ademas de datos por defecto necesarios, un usuario por con las siguientes credenciales y con el rol o cargo **'presidente'**: 
* email: admin@admin.com
* password: 1234567

4) Opcionalmente se pueden crear 100 usuarios de prueba con el comando
**php artisan db:seed --class=UserSeeder**
* Si se desea cambiar la cantidad de usuarios para crear se debe modificar el archivo en la carpeta **/database/seeders/UserSeeder.php** buscar la funcion **run** y modificar la parte donde dice **->count(100)** cambiando el numero 100 a la cantidad deseada.


## Ejecutar aplicacion

*Para ejecutar la aplicacion usar el comando **php artisan serve**