<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response;

/**
 * Class CityResponse
 *
 * @package Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response
 */
class CityResponse
{

    /** @var int */
    private int $cityId;

    /** @var string */
    private string $name;

    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /**
     * CityResponse constructor.
     *
     * @param int $cityId
     * @param string $name
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(int $cityId, string $name, float $latitude, float $longitude)
    {
        $this->cityId = $cityId;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
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
