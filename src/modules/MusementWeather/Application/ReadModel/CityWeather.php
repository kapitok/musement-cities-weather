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

    /** @var City */
    private City $city;

    /** @var Weather */
    private Weather $weather;

    /**
     * CityWeather constructor.
     *
     * @param City $city
     * @param Weather $weather
     */
    public function __construct(City $city, Weather $weather)
    {
        $this->city = $city;
        $this->weather = $weather;
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->city->getName();
    }

    /**
     * @return string
     */
    public function getTodayCondition(): string
    {
        return $this->weather->getTodayCondition()->toString();
    }

    /**
     * @return string
     */
    public function getTomorrowCondition(): string
    {
        return $this->weather->getTomorrowCondition()->toString();
    }

}
