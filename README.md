## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build site`.


Note:- 
The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **php** - `:9000`
- **mysql** - `:3306`


You can use By

API By

````
http://localhost/api/users?provider=DataProviderY
http://localhost/api/users?provider=DataProviderX
//
http://localhost/api/users?balanceMin=100&balanceMax=300
http://localhost/api/users?provider=authorised
//
http://localhost/api/users?currency=AED
http://localhost/api/users?currency=USD
http://localhost/api/users?currency=EPG
````
for Testing run 

``
composer test
``

or

``./vendor/bin/phpunit
``
or
``
php artisan test
``
