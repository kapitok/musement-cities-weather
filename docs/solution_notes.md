##SOLUTION NOTES

###IMPROVEMENTS LIST:
* Functional Test based on InMemory repositories (app env config is required: different DI container for test environment)
* Integration tests (happy path): behat or codeception
* Error handling and mapping for every layer of application: domain, application, infrastructure.
* Rest client should be cleaned from methods ``getWeatherByCoordinates`` and ``getCities``. 
* [Performence] Parallel weather data download. We can use here
Guzzle Promises ``curl_multi_exec``
* Common docker image should be used in CI/CD and for DEV, PROD environment
* Logging
