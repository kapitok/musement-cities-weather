<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response;

class CityResponse
{

    /** @var int */
    private int $id;

    /** @var string */
    private string $name;

    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /**
     * CityResponse constructor.
     */
    public function __construct(int $id, string $name, float $latitude, float $longitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

}
