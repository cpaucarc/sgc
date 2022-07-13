![sgc-portada](https://user-images.githubusercontent.com/52868996/175842421-dc5c0729-5451-4e86-868e-69bcf9c7aef7.png)

# Sistema de Gestión de Calidad
> Oficina General de Calidad Universitaria (**OGCU**)

### ⚙️ Pre-requisitos
- Git
- PHP 8 o mayor
- Composer 2.2
- MySQL 5.7
- NodeJS 16.15
- NPM 8.5

### 📦 Tecnologías Usadas
- Laravel 9
- Livewire
- MySQL 5.7
- TailwindCSS 3.0

## 🧑‍💻 Instalación en local

#### Clonar el proyecto e ingresar a la carpeta
```
  $ git clone https://github.com/cpaucarc/sgc.git
  $ cd sgc/
```
#### Instalar las dependencias
```
  $ composer install
  $ npm install
```
#### Configurar las variables de entorno
```
  $ cp .env.example .env
  $ php artisan key:generate
```
#### Crear la base de datos en MySQL (solo DB, sin tablas)

#### Migrar las tablas y la información en el Seeder
```
  $ php artisan migrate --seed
```
#### Levantar el servidor local
```
  $ php artisan serve
```
## 🐋 Instalación en Docker

#### Generar el archivo .env
```
  $ cp .env-example a .env
```
#### Configurar el archivo .env
```
  APP_NAME=SGC
  APP_ENV=production
  APP_KEY=__composer__
  APP_DEBUG=false

  DB_HOST=db
  DB_USERNAME=ogcuunasam
  DB_PASSWORD=ogcuUserMysql2022

  OGE_TOKEN=__token__
  OGE_API=__path__

  APP_VERSION=2.0
```
#### Levantar los contenedores
```
  $ docker-compose up -d --build
```
#### Crear base de datos
```
  $ docker exec -it sgc_db_1 bash -l
  $ mysql -h db -u ogcuunasam -pogcuUserMysql2022
  $ CREATE SCHEMA sgc;
```
#### Instalar las dependencias de composer
```
  $ docker exec -it sgc_app_1 /bin/bash
  $ composer install
    $ composer install --no-dev (si no se va a ejecutar seeders)
  $ php artisan key:generate
  $ php artisan storage:link
  $ php artisan migrate --seed
```
#### Insertar datos en la BD (que no estuvieran en los seeders) [Opcional]
```
  $ docker exec -it sgc_db_1 bash -l
  $ mysql -h db -u ogcuunasam -pogcuUserMysql2022
  $ INSERT INTO ....
```
#### Instalar Node 16 en Ubuntu (global) [Opcional]
```
  $ curl -s https://deb.nodesource.com/setup_16.x | sudo bash
  $ sudo apt install nodejs -y
```
#### Instalar las dependencias de Node
ℹ️ Los volumenes de los contenedores ya deben de haber sido creados al ejecutar `docker compose up`

ℹ️ Cualquier cambio fuera, se reflejará en el contenedor, por ello se instalan las dependencias de esta manera
```
  $ npm install
  $ npm run prod
```
