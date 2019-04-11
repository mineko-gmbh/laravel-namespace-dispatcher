DOCKER_CMD=docker-compose run php

install:
	$(DOCKER_CMD) composer install
	
test:
	$(DOCKER_CMD) composer test