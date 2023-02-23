# Pasos para la instalación de un proyecto en Laravel

1. Para crear un nuevo proyecto usar el comando: `composer create-project laravel/laravel devstagram`
* devstagram es el nombre de la carpeta

2. Crear una base de datos

3. Cambiar las variables de entorno con las credenciales de la base de datos en el archivo **.env**

4. Para confirmar la conexión usamos el comando: `php artisan migrate`
* Ejecuta las migraciones

5. Si queremos limpiar las tablas creadas por Laravel es con el comando: `php artisan migrate:rollback`
* Regresa o elimina las migraciones
* `php artisan migrate:rollback --step=5` Significa regresar 5 migraciones
* `php artisan make:migration agregar_imagen_user` especificar un nombre
*Funciona como un truncate para todas las tablas `php artisan migrate:refresh`

6. Para ejecutar el servidor es por medio del comando: `php artisan serve`

7. Instalar TailwindCSS: `npm install -D tailwindcss postcss autoprefixer`

8. Crear los archivos de configuracion de Tailwind: `npx tailwindcss init -p`
* En el app.css agregar lo siguiente:
    @tailwind base;
    @tailwind components;
    @tailwind utilities;

9. Para ejecutar vite en la terminar es con el comando: `npm run dev`
* Si se usa un container o width y no se ve los cambios, lo solucionamos deteniendo y volviendo activar vite

10. Crear el layout principal
* Importar las clases de @vite

11. Comando para crear un controlador: `php artisan make:controller RegisterController`

12. Para las validacion en español clonamos la siguiente repo `git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang/es`

13. Despues en la ruta /config/app.php linea 85 cambiamos el lang a 'es'

14. Para crear migraciones es por medio del comando: `php artisan make:migration add_username_to_users_table`
`php artisan make:migration create_posts_table`
`php artisan make:migration add_imagen_field_to_users_table`
`php artisan make:model --migration --controller Comentario`
`php artisan make:model --migration --controller Like`
`php artisan make: model Follower -mc` mc = Migration y controller
* add_username_to_users_table representa el nombre de la migracion
* Las migraciones se usan para realizar cambios en la bd

15. Comando para crear modelos: `php artisan make:model Cliente`
* El nombre del modelo inicia con mayuscula en singular
* Automaticamente laravel busca la tabla en la bd con el nomber en plural
* Si agregamos un campo nuevo se lo tenemos que indicar al modelo

16. Para agregar algun componente por medio del composer es por medio de la terminal. Despues en el archivo config/app.php en el arreglo de providers agregar la clase. Tambien agregar el alias en la seccion de abajo.

/* package autodiscovery (discovered package) en laravel es la instalacion de un paquete y automaticmente laravel actualiza el archivo autoload */

17. Un factory nos permite hacer testing a la bd durante el desarrollo
* para testear esto usamos tinker, tinker es un CLI que ya integra laravel en que cual puede interactuar entre la aplicacion y la bd
`php artisan tinker` | `$usuario = User::find(5)` | `Post::factory()` | `Post::factory()->times(100)->create()` | `exit` | `$usuario->posts`

18. Los policy hace validaciones
`php artisan make:policy PostPolicy --model=Post`

18. Si realizamos un cambio a las rutas y no se ve el cambio, tenemos que limpiar el cache: `php artisan route:cache`

19. Si queremos ver todas las rutas que existen en el proyecto usamos el siguiente comando: `php artisan route:list`

20. Los componentes sirven como templates: `php artisan make:component ListarPost`
* Crea 2 archivos: 
    .blade.php = vista
    .php = componente, este sirve para indicarle los parametros si es que usa
* Su sintaxis en el .blade.php es <x-ejemplo/> o <x-ejemplo> texto dentro de la etiqueta </x-ejemplo>

21. Cuando trabajamos con componentes y queremos refrescar las vistas usamos este comando: `php artisan view:clear`

22.Para instalar Livewire lo hacemos por composer: `composer require livewire/livewire`
* Livewire es un framework de laravel que toma el funcionamiento del virtual DOM

23. Para crear un archivo de livewire es por medio de: `php artisan make:livewire like-post`
* el guión medio señala que la siguiente palabra inicia en mayuscula Ej. likePost
* Crea 2 archivos:
    .php = Consultar la base de datos o crear validaciones
    .blade.php = vista
* Forma de usarlos en el .blade.php <livewire:vista-ejemplo :variable="$variable">
* Si se trava usar el comando: `php artisan livewire:publish --assets`

# Produccion
1. Crear el repositorio de github
* Si clomanos el lang para los mensajes en español es mejor importarlo manualmente
2. Modificar el archivo AppServiceProvider.php y agregar el siguiente condicional en la funcion boot:
```php
if ($this->app->environment('production')) {
    URL::forceScheme('https');
}
```