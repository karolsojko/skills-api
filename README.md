Skills API
==========

[![Deploy to Docker Cloud](https://files.cloud.docker.com/images/deploy-to-dockercloud.svg)](https://cloud.docker.com/stack/deploy/)

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
