# Todo List 
Este ejemplo de api desarrollada con SLIM simula un TodoList que iremos creandola de forma progresiva.


# SPRINTS
**SPRINT 1:**
- Reestructuracion nueva estructura de directorios y carpetas.
- Todas las claves y tokens se llevan a fichero *.env* en la raiz del proyecto
- Eliminado Clase Database.php , las conexiones de los modelos se hacen a traves del container de dependencias y cargando los datos 
  de configuración e inyectandolos por el constructor.
- Añadida migracion y Seeds del SPRINT1
- Añadido la gestion de la API de Categorias (categories)
- Añadido la posibilidad de trabajar con FluentPDO o PDO, configurable en el fichero de configuracion.


## Instalacion SPRINT 1
1. Descargar una copia a tu ordenador.
2. Ejecutar en la terminal: *composer install* para descargar dependencias.
3. Ajustar configuracion de BBDD en */src/config/development/config.php* y en el fichero que se usa para las migraciones *phinx.yml*
4. Crear la base de datos que se vaya a usar y que tenga el mismo nombre que en los ficheros de configuracion
5. Ejecutar la migracion para crear las tablas (creará 4) tecleando en la terminal: *vendor/bin/phinx migrate -e development* 
6. Cargar las seeds a las tablas, para ello ejecuta en la terminal: *vendor/bin/phinx seed:run -s Sprint1Seeder* 
7. En la terminal, teclear: *php -S localhost:8080/public*
