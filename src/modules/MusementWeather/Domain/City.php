<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;

/**
 * Class City
 *
 * @package Mlozynskyy\MusementWeather\Domain
 */
class City
{

    private int $cityId;

    private string $name;

    private Coordinates $coordinates;

    /**
     * City constructor.
     *
     * @param int $cityId
     * @param string $name
     * @param Coordinates $coordinates
     */
    public function __construct(int $cityId, string $name, Coordinates $coordinates)
    {
        $this->cityId = $cityId;
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

}
