# Installation guide

- Pull the code
- Run ```composer install```
- Create copy of the ".env.example" file and name it ".env" ```cp .env.example .env```
- Create a database and add information in Env file
- Run ```php artisan migrate```
- Run ```php artisan db:seed```
- Run ```yarn install``` or ```npm install```

# Required to be installed on your machine

- Composer
- Node (I have 12.17)
- yarn
- An application to handle a php server (wamp/mamp/xamp)

## To run the project locally

- Run ```yarn hot``` or ```npm run hot```
- Start your php server, run ```php artisan serve```
