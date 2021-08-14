<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Application\Repository;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\Weather;

/**
 * Interface WeatherRepositoryInterface
 *
 * @package Mlozynskyy\MusementWeather\Application\Repository
 */
interface WeatherRepositoryInterface
{

    /**
     * @param Coordinates $coordinates
     * @param int $days
     * @return Weather
     */
    public function getByCoordinates(Coordinates $coordinates, int $days): Weather;

}
