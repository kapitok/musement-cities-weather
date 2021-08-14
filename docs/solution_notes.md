##SOLUTION NOTES

###IMPROVEMENTS LIST:
* Functional Test based on InMemory repositories (APP Env config is required)
* Integration tests (happy path). Behat or Codeception
* Error handling for every layer of application: domain, application, infrastructure. Error mapping in Presentation layer
* Rest client should be cleaned from methods ``getWeatherByCoordinates`` and ``getCities`` . 
* [Performence] Parallel weather data download. We can use here
Guzzle Promises ``curl_multi_exec``
* Common docker image should be used in CI/CD and for DEV, PROD environment  
  
###DECISIONS
* Due to php 7.4 advantages we do not need PHPDocs everywhere but sometimes it is required from older IDEs that is why I decided to use them here
* Symfony DI container and SymfonyConsole component helps me to make this app testable
  
