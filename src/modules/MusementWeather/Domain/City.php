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

    private int $id;

    private string $name;

    private Coordinates $coordinates;

    /**
     * City constructor.
     */
    public function __construct(int $id, string $name, Coordinates $coordinates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    public function getId(): int
    {
        return $this->id;
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
