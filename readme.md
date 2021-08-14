# Musement Weather App

Console application which allows printing of weather information for each city available in Musement's catalogue.

## Installation

####Step 1
Create and put .env file in the project root. Weatherapi.com has a free plan. Create your own account to get a key (API_WEATHER_KEY).

```
API_WEATHER_URI="http://api.weatherapi.com"
API_WEATHER_KEY="YOUR API WEATHER KEY HERE"
API_MUSEMENT_URI="https://api.musement.com"
```

####Step 2
Run DockerCompose from the root folder:

```
docker-compose -f docker-compose.yml up
```
####Step 3
Run command from docker container:
```
docker exec -it container_musement_weather_php_1 bash
```

####Step 4
Execute command from the console of container:

```
php public/index.php app:cities:list
```
## Tests
###PHPUnit
```
composer phpunit
```

###Static code analyzer
```
composer static_analyze
```

##Author
Mykhailo Lozynskyy <lozynskyy.m@gmail.com>
