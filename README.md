## Minimum requirements
**PHP 8.0**,
**MariaDB 10**,
**Apache 2**

## Configuration
I run this project on XAMPP server. You may use another one.

Edit **migrations/MigrationConfig.php** and **models/Config.php** to get access to your database server.

Run the next command to create and fill the database:

> php migrations/migrate.php

## Access to admin

You can use **http://HOST_NAME/admin** with login and password **admin** to get access to admin part.
