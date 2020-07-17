<p align="center">DTHOCM - Complaint Management System</p>

## Installation Step

1. Download Project Locally
    git clone https://github.com/hsengar/dthocm.git
2. cd into your project
    open cmd and now goto your project folder using cd command
3. Install Composer Dependencies
    write command "composer install" in cmd
4. Create .env file
    Copy .env.example file contents and create new .env file and paste the copied contents
    "cp .env.example .env" in cmd
5. Generate App Encryption Key
    "php artisan key:generate" in cmd
6. Create an Empty Database in Phpmyadmin
7. Write database name DB_DATABASE=databasename in .env file
8. migrate the database
    "php artisan migrate" in cmd
9. now your laravel project is ready to just write "php artisan serve" in cmd.

# dthocm
