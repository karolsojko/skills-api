Skills API
==========

Microservice for handling skills as an entity for other applications. You can add, remove and list skills. The service is deployable to Docker Cloud. Written with usage of PHP7, Symfony 3 and MongoDB.

[![Deploy to Docker Cloud](https://files.cloud.docker.com/images/deploy-to-dockercloud.svg)](https://cloud.docker.com/stack/deploy/)

[![Build Status](https://travis-ci.org/karolsojko/skills-api.svg?branch=master)](https://travis-ci.org/karolsojko/skills-api)

To run locally

```
docker-compose up -d
```

install dependencies:

```
docker-compose run web bash
composer install -n
```

run tests:

```
docker-compose run web bin/phpspec run
```
