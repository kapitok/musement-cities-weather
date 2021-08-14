<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain\ValueObject;

/**
 * Class Coordinates
 *
 * @package Mlozynskyy\MusementWeather\Domain\ValueObject
 */
class Coordinates
{

    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /**
     * Coordinates constructor.
     *
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function isEqual(Coordinates $coordinates): bool
    {
        return $this->latitude === $coordinates->getLatitude()
            && $this->longitude === $coordinates->getLongitude();
    }

}
