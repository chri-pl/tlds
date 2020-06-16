#### Demo Projekt für Internet

### Voraussetzungen für das Ausführung des Projektes mit dem Built-in PHP Server

* Am einfachsten ein Linux Betriebssystem
* Ein PHP Server der folgende [Anforderungen](https://laravel.com/docs/7.x/installation#server-requirements) erfüllt.
* Zusätzlich werden die PHP Module **php-curl** und **php-sqlite** benötigt

### Zum Auführen der Anwendung sind folgende Schritte notwendig

> git clone https://github.com/chri-pl/tlds xyz

> cd xyz

> php artisan --env=demo migrate

> php artisan --env=demo passport:install

> php artisan --env=demo serve --port=8008

__Anschließend im Browser localhost:8008 aufrufen__