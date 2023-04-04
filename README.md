# `maria-tests`

This is a throw-away project to test the MariaDB-related things.

## Prerequisites

Before installing the project:

* Install
    * PHP 8.2
    * Composer
    * Node.js
    * Docker 2
    * Docker Compose
* [Create the `sail` shell alias](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias).

## Installation

Install the project into the `~/projects/maria-tests` directory (the "project directory"):

1. Download and prepare the project files using the following commands:

        cd ~/projects
        git clone git@github.com:osmianski/maria-tests.git
        cd maria-tests
        composer install
        php -r "file_exists('.env') || copy('.env.example', '.env');"
        php artisan key:generate --ansi

2. In a separate terminal window, start the Docker containers by running the following commands, and keeping it running there:

        cd ~/projects/maria-tests
        sail up

3. Prepare the database and optionally, seed it with sample data:

        cd ~/projects/maria-tests
        sail artisan migrate:fresh --seed

**Notice**. The seeder creates the `products` table with 1,000,000 rows in only 24 seconds!

## Testing column creation performance in big tables

The `column:add` column adds a foreign key to a table having 1M rows:

```php
Schema::table('products', function ($table) {
    $table->foreignId($this->getColumnName())
        ->nullable()
        ->constrained('products')
        ->nullOnDelete();
});
```

Here is its performance on a modest laptop:

```bash
$ sail artisan column:add
Elapsed: 6529ms
$ sail artisan column:add
Elapsed: 8317ms
$ sail artisan column:add
Elapsed: 10027ms
$ sail artisan column:add
Elapsed: 10926ms
$ sail artisan column:add
Elapsed: 11572ms
```

Overall, not bad.

Nothing unexpected, but things to note:

* The more columns you add, the longer it takes. 
* It's likely that the time will increase with the number of rows in the table.
