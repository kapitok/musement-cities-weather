<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Application\Repository;

use Mlozynskyy\MusementWeather\Domain\City;

/**
 * Interface CitiesRepositoryInterface
 *
 * @package Mlozynskyy\MusementWeather\Application\Repository
 */
interface CitiesRepositoryInterface
{

    /**
     * @return array<City>
     */
    public function getList(): array;

}
