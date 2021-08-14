<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain;

use DateTime;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;

/**
 * Class Weather
 *
 * @package Mlozynskyy\MusementWeather\Domain
 */
class Weather
{

    /**
     * @var Coordinates
     */
    private Coordinates $coordinates;

    /** @var array */
    private array $forecast = [];

    /**
     * Weather constructor.
     */
    public function __construct(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function addDay(DateTime $date, string $weatherCondition): void
    {
        $this->forecast[$date->format('Y-m-d')] = $weatherCondition;
    }

    public function getConditionByDateTime(DateTime $dateTime, string $default = ''): string
    {
        return $this->forecast[$dateTime->format('Y-m-d')] ?? $default;
    }

    public function getTodayCondition(): string
    {
        return $this->getConditionByDateTime(new DateTime(), 'No forecast for today');
    }

    public function getTomorrowCondition(): string
    {
        return $this->getConditionByDateTime(new DateTime('tomorrow'), 'No forecast for tomorrow');
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

}
