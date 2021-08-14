<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Repository;

use DateTime;
use Mlozynskyy\MusementWeather\Application\Repository\WeatherRepositoryInterface;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\Weather;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\RestClientInterface;

/**
 * Class WeatherRepository
 * @package Mlozynskyy\MusementWeather\Infrastructure\Repository
 */
class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var RestClientInterface
     */
    private RestClientInterface $restClient;

    /**
     * WeatherRepository constructor.
     * @param RestClientInterface $restClient
     */
    public function __construct(RestClientInterface $restClient)
    {
        $this->restClient = $restClient;
    }

    /**
     * @param Coordinates $coordinates
     * @param int $days
     * @return Weather
     */
    public function getByCoordinates(Coordinates $coordinates, int $days): Weather
    {
        $weatherForecastData = $this->restClient->getWeatherByCoordinates($coordinates, $days);

        $weather = new Weather(
            new Coordinates(
                $weatherForecastData->getLatitude(),
                $weatherForecastData->getLongitude()
            )
        );

        foreach ($weatherForecastData->getForecast() as $weatherConditionData) {
            $weather->addDay(
                new DateTime($weatherConditionData['date']),
                $weatherConditionData['condition']
            );
        }

        return $weather;
    }
}
