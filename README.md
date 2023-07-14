## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build site`.

After that completes, run this code

- `docker-compose run --rm composer update`
- `docker-compose run --rm artisan migrate`

Note:- 
The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **php** - `:9000`
- **mysql** - `:3306`


You can use By

API By

``
http://localhost/v1/api/movies?category_id=35&rated=desc
http://localhost/v1/api/movies
``
To update from themoviedb run this link
``
http://localhost/v1/api/update-movies
``

CLI By

``
php artisan movies:all
``

for Testing run 

``
composer test
``

or

``./vendor/bin/phpunit
``
