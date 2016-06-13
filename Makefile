run:
	docker-compose run --rm -p 8080:80 development
stop:
	docker-compose stop
test:
	docker-compose run --rm development ./vendor/bin/phpunit -c phpunit.xml
