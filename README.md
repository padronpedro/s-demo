# Assigment: Project Teams 

The following project was developed following the client requirements and according with the company’s quality standards and visual identity.

## Deployment

To deploy this project in a server, please follow the instructions below:

Server / Web hosting requirementh:
- Npm v 6.4.x
- NodeJs v 10.13.x
- PHP v 7.x
- MariaDB v 10.4.x
- Git
 
## Deployment
- Create an empty database and user and take note of the user, password and servername/port
- Select the folder when you want to deploy your project. You can create a subdomain if you need it
- Open a terminal window on the folder created
- Check if you have the requirements installed, run each command to check:
``` bash
php -v
php -m
composer --version
git
```
- Clone the project
``` bash
git clone <repo url>
```
- Run composer
``` bash
composer install
``` 
- Run npm
``` bash
npm install
``` 
- Edit or create a .env file in your folder and modify the following items in brackets (delete the brackets too):
``` bash
APP_NAME=[Project Name]
APP_ENV=local
APP_URL=http://[URL to your folder]
MIX_APP_URL=http://[URL to your folder]
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=[DB Port3306]
DB_DATABASE=[Database name]
DB_USERNAME=[Database user]
DB_PASSWORD=[Database user passowrd]

``` 
- Folder permission: run the following commands to give permission to Laravel to access/write those folders
``` bash
chmod -R o+w storage
chmod -R o+w bootstrap/cache
``` 

- Migrate the Database
``` bash
php artisan migrate:refresh
# if you want to include the demo data run
php artisan db:seed
``` 

- Prepare Laravel to be ready
``` bash
php artisan config:clear
php artisan key:generate
composer dumpautoload
``` 
- Compile frontend files
``` bash
npm run production
``` 
- Validate redirection to laravel public folder. Create a .htaccess file in the root folder with the following information:
``` bash
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
``` 
## You are ready! Open your web browser and start to use your project 

Notes:
> If you have a 500 error permission:: 
 1- Change the permission of the public folder to 755
 2- Change the permission of public/index.php to 644
 
