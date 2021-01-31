# runners-rest-api

Race Runners REST API

- PHP 7.4
- Laravel 8

## Endpoints services

GET, POST, PUT, PATCH, DELETE

- Race (Prova)
  - Fields
    - type ['3km', '5km', '10km', '21km', '42km']
    - race_date (YYYY-MM-DD)
  - Rules
    - unique pair (type, date)
  - Example

``` json
{
    "type": "10km",
    "race_date": "1998-06-22" // "22/06/1998"
}
```

- Runner (Corredor)
  - Fields
    - name
    - cpf
    - birthday (YYYY-MM-DD)
  - Rules
    - unique cpf
    - age +18
  - Example

``` json
{
    "name": "Mervin Reichert",
    "cpf": 69421294568,
    "birthday": "1982-11-22" // "22/11/1982",
}
```

- Contest (Corrida)
  - Fields
    - race_id
    - runner_id
    - started_at (Y-m-d H:i:s)
    - ended_at (Y-m-d H:i:s)
    - duration (Y-m-d H:i:s)
  - Rules
    - unique pair (race_id, runner_id)
      - unique runner per date
    - ended_at after started_at
  - Example

``` json
{
    "race_id": 3,
    "runner_id": 10,
    "started_at": "2020-03-29 02:51:47.404",
    "ended_at": "2020-03-29 03:01:03.505",
    // "duration": "00:09:16.101",
}
```

## Instalation

### Docker

#### Prerequisites

- docker

``` bash
sudo apt-get install docker-ce docker-ce-cli containerd.io
```

- docker-compose
  
``` bash
sudo apt install docker-compose
```

#### Run

``` bash
cp .env.example .env
docker-compose build
docker-compose up -d
```

## Access

``` bash
[SERVER_NAME]:[PORT] /api/ [VERSION] / [SERVICE]
```

- Example = localhost:8000/api/v0/races/
- Heroku Demo = .../api/v0/

<!-- 
## Swagger documentation

- ONLINE /api/v0/documentation
- OFFLINE localhost:8000/api/v0/documentation 
- -->
