<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Domain;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;

/**
 * Class City
 * @package Mlozynskyy\MusementWeather\Domain
 */
class City
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Coordinates
     */
    private Coordinates $coordinates;

    /**
     * City constructor.
     *
     * @param int $id
     * @param string $name
     * @param Coordinates $coordinates
     */
    public function __construct(int $id, string $name, Coordinates $coordinates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }
}
