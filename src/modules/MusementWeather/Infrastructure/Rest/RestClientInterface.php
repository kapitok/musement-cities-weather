<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response\WeatherResponse;

/**
 * Interface RestClientInterface
 *
 * @package Mlozynskyy\MusementWeather\Infrastructure\Rest
 */
interface RestClientInterface
{

    /** @return array<CityResponse> */
    public function getCities(): array;

    /**
     * @param Coordinates $coordinates
     * @param int $days
     * @return WeatherResponse
     */
    public function getWeatherByCoordinates(Coordinates $coordinates, int $days): WeatherResponse;

}
