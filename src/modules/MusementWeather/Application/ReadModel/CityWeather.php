<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Application\ReadModel;

use Mlozynskyy\MusementWeather\Domain\City;
use Mlozynskyy\MusementWeather\Domain\Weather;

/**
 * Class CityWeather
 *
 * @package Mlozynskyy\MusementWeather\Application\ReadModel
 */
class CityWeather
{

    private City $city;

    private Weather $weather;

    /**
     * CityWeather constructor.
     */
    public function __construct(City $city, Weather $weather)
    {
        $this->city = $city;
        $this->weather = $weather;
    }

    public function getCityName(): string
    {
        return $this->city->getName();
    }

    public function getTodayCondition(): string
    {
        return $this->weather->getTodayCondition();
    }

    public function getTomorrowCondition(): string
    {
        return $this->weather->getTomorrowCondition();
    }
}
