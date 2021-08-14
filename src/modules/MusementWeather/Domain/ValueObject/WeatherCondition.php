<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain\ValueObject;

/**
 * Class WeatherCondition
 *
 * @package Mlozynskyy\MusementWeather\Domain\ValueObject
 */
class WeatherCondition
{

    /** @var string */
    private string $condition;

    /**
     * WeatherCondition constructor.
     *
     * @param string $condition
     */
    private function __construct(string $condition = '')
    {
        $this->condition = $condition;
    }

    /**
     * @param string $condition
     * @return WeatherCondition
     */
    public static function fromString(string $condition): WeatherCondition
    {
        return new self($condition);
    }

    /**
     * @return WeatherCondition
     */
    public static function empty(): WeatherCondition
    {
        return new self();
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->condition;
    }

    /**
     * @param WeatherCondition $weatherCondition
     * @return bool
     */
    public function isEqual(WeatherCondition $weatherCondition): bool
    {
        return $this->condition === $weatherCondition->toString();
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->condition);
    }

}
