<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain\Exception;

use Exception;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Date;

/**
 * Class DateHasAlreadyPassed
 *
 * @package Mlozynskyy\MusementWeather\Domain\Exception
 */
class DateHasAlreadyPassed extends Exception
{

    /**
     * @param Date $date
     * @return DateHasAlreadyPassed
     */
    public static function with(Date $date): self
    {
        return new self(sprintf('Date has already passed: %s', $date->toString()));
    }

}
