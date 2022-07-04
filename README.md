# Simple Symfony application based on symfony-docker

A RESTful application, that contain 2 entities - `Account` and `Team` with following structure:
``` 
Account {
    int $id
    string $name
    int $teamId
}
```

```
Team
{
    int $id
    string $name
}
```
Entity exposed in ApiPlatform UI by `/api` endpoint.

Data for test purposes can be generated on the fly on demand by data fixtrures (`php bin/console doctrine:fixtures:load`).
Number of generated records can be editable in config file(`config/services.yml`)

This application provides reports in json and xml formats by following endpoints:
`/api/report/json`
`/api/report/xml`

Example of `JSON` report should be like this:
```
{
    "teams": [
        {
            "name": "Team Alpha",
            "size": 2,
            "accounts": [
                {
                    "id": 1,
                    "name": "John Doe"
                },
                {
                    "id": 2,
                    "name": "Jane Doe"
                }
            ]
        },
        {
            "name": "Team Bravo",
            "size": 0,
            "accounts": []
        }
    ]
}
```

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

## Docs

1. [Build options](docs/build.md)
2. [Using Symfony Docker with an existing project](docs/existing-project.md)
3. [Support for extra services](docs/extra-services.md)
4. [Deploying in production](docs/production.md)
5. [Installing Xdebug](docs/xdebug.md)
6. [Using a Makefile](docs/makefile.md)
7. [Troubleshooting](docs/troubleshooting.md)