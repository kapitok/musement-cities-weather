<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response;

class CityResponse
{
    /** @var int  */
    private int $id;

    /** @var string  */
    private string $name;

    /** @var float  */
    private float $latitude;

    /** @var float  */
    private float $longitude;

    /**
     * CityResponse constructor.
     * @param int $id
     * @param string $name
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(int $id, string $name, float $latitude, float $longitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
}
