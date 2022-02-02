## Instalación

Para instalar el proyecto, usando Docker, se debe ejecutar el siguiente comando:

    docker-compose up -d
    docker-compose exec laravel php artisan key:generate
    docker-compose exec laravel php artisan migrate


Para instalar el proyecto sin Docker, configurar las credenciales de la base de datos y luego ejecutar los siguientes comandos:

    copy .env.example .env
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan serve

## Colección de Postman
    
La colección de Postman se encuentra en la siguiente dirección:

    Path: Xcoop.postman_collection.json
