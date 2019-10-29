test:
	composer run-script phpunit tests
install:
	composer install
run:
	php -S localhost:8000 -t public
lint:
	composer run-script phpcs -- --standard=PSR12 app routes tests --ignore=*/app/Http/Controllers/Auth/*