## Installation

If you don't have docker installed in your computer, visit https://www.docker.com/ to download and install docker in your machine.

After you clone the project into your machine, navigate to the project directory and run the following commands:

`composer install`
<br>
`npm install`
<br>
`php artisan sail:install` and select mysql from the list
<br>
`./vendor/bin/sail up`

In order to run artisan commands, use `sail artisan` instead of `php artisan`

### Database Migration

Make sure to set the DB_HOST in your .env file to mysql

`DB_HOST=mysql`
<br>
`DB_DATABASE=todo`

Run the migrations and database seeder

`sail artisan migrate`<br> `sail artisan db:seed`

### Admin Credentials

Use the following credentials to login as an administrator

**Email Address**: john_doe@admin.com <br>**Password**: admin1234

