<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response\WeatherResponse;

/**
 * Interface RestClientInterface
 *
 * @package Mlozynskyy\MusementWeather\Infrastructure\Rest
 */
interface RestClientInterface
{

    /** @return array<\Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse> */
    public function getCities(): array;

    public function getWeatherByCoordinates(Coordinates $coordinates, $days): WeatherResponse;

}
