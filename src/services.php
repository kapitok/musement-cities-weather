<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mlozynskyy\MusementWeather\Application\Repository\CitiesRepositoryInterface;
use Mlozynskyy\MusementWeather\Application\Repository\WeatherRepositoryInterface;
use Mlozynskyy\MusementWeather\Application\Service\CitiesWeatherService;
use Mlozynskyy\MusementWeather\Infrastructure\Repository\CitiesRepository;
use Mlozynskyy\MusementWeather\Infrastructure\Repository\WeatherRepository;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\Client;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\RestClientInterface;
use Mlozynskyy\MusementWeather\ModuleConfig;
use Mlozynskyy\MusementWeather\Presentation\Cli\CitiesWeatherCommand;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services
        ->set(CitiesWeatherCommand::class)
        ->tag('consoleCommand')
        ->public();

    $services->set(CitiesWeatherService::class);
    $services->set(CitiesRepository::class);
    $services->set(WeatherRepository::class);
    $services->set(Client::class);
    $services->set(ModuleConfig::class);

    $services->alias(CitiesRepositoryInterface::class, CitiesRepository::class);
    $services->alias(WeatherRepositoryInterface::class, WeatherRepository::class);
    $services->alias(RestClientInterface::class, Client::class);
};
