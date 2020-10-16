# Task Manager    

[![CI](https://github.com/mvaload/Task-Manager/workflows/CI/badge.svg)](https://github.com/mvaload/Task-Manager/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/a979f34ff98958dda049/maintainability)](https://codeclimate.com/github/mvaload/Task-Manager/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/a979f34ff98958dda049/test_coverage)](https://codeclimate.com/github/mvaload/Task-Manager/test_coverage)

Link to heroku domain: https://intense-basin-23419.herokuapp.com/

### Install
`git clone https://github.com/ini1990/php-project-lvl4.git`
### Setup
`composer install`  

Create .env file and set up some keys like db connection, mailtrap, rollbar if you need thats

`cp -n .env.example .env|| true`  

Create database.sqlite or install other db

`touch database/database.sqlite`  

Keep on
```
php artisan key:gen --ansi
php artisan migrate
php artisan db:seed --class=TaskSeeder
npm install
```
### Launch localhost
`make run`
### Run tests
`make test`
