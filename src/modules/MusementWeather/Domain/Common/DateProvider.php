<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain\Common;

use DateTime;

/**
 * Class DateProvider
 *
 * @package Mlozynskyy\MusementWeather\Domain\Common
 */
class DateProvider
{

    /** @var DateTime|null */
    private static ?DateTime $frozen = null;

    /**
     * @return DateTime
     */
    public static function now(): DateTime
    {
        if (static::$frozen instanceof DateTime) {
            return static::$frozen;
        }

        return new DateTime();
    }

    /**
     * @return DateTime
     */
    public static function yesterday(): DateTime
    {
        if (static::$frozen instanceof DateTime) {
            $frozen = clone static::$frozen;

            return $frozen->modify('-1 day');
        }

        return new DateTime('-1 day');
    }

    /**
     * @return DateTime
     */
    public static function tomorrow(): DateTime
    {
        if (static::$frozen instanceof DateTime) {
            $frozen = clone static::$frozen;

            return $frozen->modify('+1 day');
        }

        return new DateTime('tomorrow');
    }

    /**
     * @param DateTime $dateTime
     */
    public static function freeze(DateTime $dateTime): void
    {
        static::$frozen = $dateTime;
    }

    public static function release(): void
    {
        static::$frozen = null;
    }

    /**
     * @param string $modifier
     */
    public static function move(string $modifier): void
    {
        $frozenDateTime = clone static::$frozen;

        if (empty($frozenDateTime)) {
            return;
        }

        static::$frozen = $frozenDateTime->modify($modifier);
    }

}
