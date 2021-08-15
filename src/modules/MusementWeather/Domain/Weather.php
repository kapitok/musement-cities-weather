<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain;

use Mlozynskyy\MusementWeather\Domain\Exception\DateHasAlreadyPassed;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Date;
use Mlozynskyy\MusementWeather\Domain\ValueObject\WeatherCondition;

/**
 * Class Weather
 *
 * @package Mlozynskyy\MusementWeather\Domain
 * @SuppressWarnings("static")
 */
class Weather
{

    /**
     * @var Coordinates
     */
    private Coordinates $coordinates;

    /** @var array<string, WeatherCondition> */
    private array $forecast = [];

    /**
     * Weather constructor.
     *
     * @param Coordinates $coordinates
     */
    public function __construct(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @param Date $date
     * @param WeatherCondition $weatherCondition
     */
    public function addDay(Date $date, WeatherCondition $weatherCondition): void
    {
        $this->assertThatDateHasPassed($date);

        $this->forecast[$date->toString()] = $weatherCondition;
    }

    /**
     * @param Date $date
     * @return WeatherCondition
     */
    public function getConditionByDate(Date $date): WeatherCondition
    {
        return $this->forecast[$date->toString()] ?? WeatherCondition::empty();
    }

    /**
     * @return WeatherCondition
     */
    public function getTodayCondition(): WeatherCondition
    {
        $condition = $this->getConditionByDate(Date::today());

        return $condition->isEmpty()
            ? WeatherCondition::fromString('No forecast for today')
            : $condition;
    }

    /**
     * @return WeatherCondition
     */
    public function getTomorrowCondition(): WeatherCondition
    {
        $condition = $this->getConditionByDate(Date::tomorrow());

        return $condition->isEmpty()
            ? WeatherCondition::fromString('No forecast for tomorrow')
            : $condition;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @param Date $date
     * @throws DateHasAlreadyPassed
     */
    private function assertThatDateHasPassed(Date $date): void
    {
        if ($date->hasPassed()) {
            throw DateHasAlreadyPassed::with($date);
        }
    }

}
