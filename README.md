
<p align="center"><h2>Ami Coding Pari Na Project Demo</h2></p>

## Github link
	- https://github.com/Shakil776/coding-pari-na

## Live Server link
    - http://acpn.techbcd.com/

## How to use this project

    * Clone the project.

    * Extract the project in your directory where you want to put your project.

    * Go to the project folder using cd command on your cmd or terminal.

    * Set up the database: 
            => Create a database which name is db_ami_coding_pari_na
            => Import the database from the project folder DB/db_ami_coding_pari_na.sql (Note: After importing the database you can delete the DB folder with db_ami_coding_pari_na.sql from the project folder.)
    * Run composer install on your cmd or terminal

    * Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu Open your .env file and change the database name (DB_DATABASE=db_esellers) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

    * By default, the username is root and you can leave the password field empty. (This is for Xampp)

## Use the Following step to run the project 
    => Go to the project folder using cmd or terminal then use the command
    1. composer install / composer update
    2. copy .env.example .env (from your windows cmd)
    3. php artisan key:generate
    4. Now configure your database username, password, host etc in your .env file
    5. php artisan migrate
    6. php artisan serve

    Go to 127.0.0.1:8000

    If there was occured any error then run the following command and restart your local server

     1. php artisan config:clear
     2. php artisan cache:clear



## Modules

## Section 1

- [User Authentication/Registration Page

## Section 2

- [Khoj the search Page

## Section 3 (Used tymon/jwt-auth)

- [API Endpoints
- [Login URL: http://127.0.0.1:8000/api/auth/login
- [GET all input values URL: http://127.0.0.1:8000/api/values/get-all-values/1


## Bonus

- [Token based authentication system in API
- [Host the application in your own hosting
- [Creative way to design the frontend.


