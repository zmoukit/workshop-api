## E-Workshop API

E-Workshop API is a comprehensive car workshops management system.

Within the API, The Car Solutions staff could list created appointments, create a new appointment and check the availability of the workshops.

## Features

E-Workshop API permits The Car Solution staff to access to the following resources:

1 - List down all the appointments.
2 - List down appointments by workshop .
3 - Schedule an appointment.
4 - Recommend workshops based on availability.

## Installation

-   Clone repository

```
$ git clone https://github.com/zmoukit/workshop-api.git
```

-   Run in your terminal

```
$ composer install
$ php artisan key:generate
```

-   Setup database connection in .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

-   Migrate tables and seed with demo data

```
$ php artisan migrate --seed
```

-   Launch the server

```
$ php artisan serve
```

## License

E-Workshop API is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
