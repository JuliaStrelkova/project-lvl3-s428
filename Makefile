install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 app bootstrap tests

cs-fix:
	composer run-script phpcbf -- --standard=PSR12 app bootstrap tests

test:
	composer run-script phpunit tests

run:
	php -S localhost:8000 -t public

logs:
	tail -f storage/logs/lumen.log

db:
	psql -h localhost -d page_analyzer -U app -W
