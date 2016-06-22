run:
	docker-compose run --rm -p 8080:80 development
in:
	docker exec -i -t $(shell docker-compose ps | grep run | cut -d" " -f 1) /bin/bash
stop:
	docker-compose stop
test:
	docker-compose run --rm development ./vendor/bin/phpunit -c phpunit.xml
