<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain\ValueObject;

use DateTime;
use Mlozynskyy\MusementWeather\Domain\Common\DateProvider;

/**
 * Class Date
 *
 * @package Mlozynskyy\MusementWeather\Domain\ValueObject
 * @SuppressWarnings("static")
 */
class Date
{

    private const DATE_FORMAT = 'Y-m-d';

    /** @var DateTime */
    private DateTime $dateTime;

    /**
     * Date constructor.
     *
     * @param DateTime $dateTime
     */
    private function __construct(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @param string $dateTime
     * @return Date
     */
    public static function fromString(string $dateTime): Date
    {
        return new self(new DateTime($dateTime));
    }

    /**
     * @return Date
     */
    public static function today(): Date
    {
        return new self(DateProvider::now());
    }

    /**
     * @return Date
     */
    public static function tomorrow(): Date
    {
        return new self(DateProvider::tomorrow());
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->dateTime->format(self::DATE_FORMAT);
    }

    /**
     * @param Date $dateValueObject
     * @return bool
     */
    public function isEqual(Date $dateValueObject): bool
    {
        return $this->toString() === $dateValueObject->toString();
    }

    /**
     * @return bool
     */
    public function hasPassed(): bool
    {
        return $this->dateTime <= DateProvider::yesterday();
    }

}
