setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:gen --ansi
	touch database/database.sqlite || true
	php artisan migrate
lint:
	composer phpcs
lint-fix:
	composer phpcbf
test:
	php artisan config:clear
	php artisan test
test-coverage:
	php artisan test --coverage-clover ./build/logs/clover.xml
deploy:
	git push heroku
migrate:
	php artisan migrate
console:
	php artisan tinker
run:
	php artisan serve
logs:
	tail -f storage/logs/laravel.log
