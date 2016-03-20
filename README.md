Nami Demo Application
========================

Welcome to the NAMI Demo Application - a fully-functional NAMI
application that you can use as the skeleton for your new applications.

![Nami Logo](https://github.com/phpink/nami-core-bundle/raw/master/Docs/namiLogo.png)

For details on how to download and get started with Symfony, see the
installation chapter of the Symfony Documentation.

Docker containers
--------------

[Docker][1] containers are available to use :

* Nginx + PhpFpm container => nami.dev
* Mysql container          => mysql.dev

To get your environment ready, run :

    user@local:/dev$ docker-compose run --no-cache && docker-compose run
    
And get the application ready :

    user@local:/dev$ docker exec -ti cms_nami /bin/bash
    
    root@ad46b:/var/www$ composer install  
    
    root@ad46b:/var/www$ php app/console check

[1]:  https://docs.docker.com/
