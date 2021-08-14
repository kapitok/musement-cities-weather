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

    public function getByCoordinates(Coordinates $coordinates, int $days): Weather;
}
