###Quick guide to set up an environment of this Laravel API
- 1 Install docker
- 2 InstalL PostgreSQL (13.1), set up .env(or .env.example) and /config/database.php file with your user and database (create new DB and make your user role permissions to CRUD-access your database)
- 3 Install composer in a API root directory
- 4 ./vendor/bin/sail up & to start


###To migrate changes of database:
in your root directory of an API execute next command:

    php artisan migrate:fresh


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

#Project overview

##Features

###User Authentication and Registration

User authentication and registration system made on top of
[Laravel Sanctum (SPA)](https://laravel.com/docs/8.x/sanctum#spa-authentication) 
and [Laravel Fortify](https://laravel.com/docs/8.x/fortify) packages.
For social authentication we used [Laravel Socialite](https://laravel.com/docs/8.x/socialite) package with
[Socialite Providers](https://socialiteproviders.com/)
