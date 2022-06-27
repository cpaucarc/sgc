![sgc-portada](https://user-images.githubusercontent.com/52868996/175842421-dc5c0729-5451-4e86-868e-69bcf9c7aef7.png)

# Sistema de Gestión de Calidad
> Oficina General de Calidad Universitaria (**OGCU**)

### Pre-requisitos
- Git
- PHP 8 o mayor
- Composer 2.2
- MySQL 5.7
- NodeJS 16.15
- NPM 8.5

### Tecnologías Usadas
- Laravel 9
- Livewire
- MySQL 5.7
- TailwindCSS 3.0

### Instalación (en local)

###### # Clonar el proyecto e ingresar a la carpeta
`$ git clone https://github.com/cpaucarc/sgc.git`

`$ cd sgc/`

###### # Instalar las dependencias
`$ composer install`

`$ npm install`

###### # Configurar las variables de entorno
`$ cp .env.example .env`

`$ php artisan key:generate`

###### # Crear la base de datos en MySQL (solo DB, sin tablas)
###### # Migrar las tablas y la información en el Seeder
`$ php artisan migrate --seed`
###### # Levantar el servidor local
`$ php artisan serve`
