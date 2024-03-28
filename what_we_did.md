`composer create-project laravel/laravel=10 Backend`

`git init`
`git commit`
`git push`

setup db connection in `.env`

`composer require laravel/sanctum`

`php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`

adjust kernel.php to use middleware 

`php artisan migrate`

edit User model db structure

`php artisan make:seeder DefaultAdmin`
create default admin user 

make userstore request 
make auth controller
add api routes

