<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response;

use Nette\Utils\Arrays;

class WeatherResponse
{

    /** @var string */
    private string $locality;

    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /** @var array<array> */
    private array $forecastData;

    /**
     * WeatherResponse constructor.
     *
     * @param string $locality
     * @param float $latitude
     * @param float $longitude
     * @param array<array> $forecastData
     */
    public function __construct(string $locality, float $latitude, float $longitude, array $forecastData)
    {
        $this->locality = $locality;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->forecastData = $forecastData;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * <code>
     * $array = [
     *   'date' => '2021-08-14', //date format Y-m-d
     *   'condition' => 'Partly cloudy',
     * ];
     * </code>
     *
     * @return array<array>
     * @SuppressWarnings("static")
     */
    public function getForecast(): array
    {
        return array_map(static function ($dayForecastData) {
            return [
                'date' => $dayForecastData['date'],
                'condition' => Arrays::get($dayForecastData, ['day', 'condition', 'text'], ''),
            ];
        }, $this->forecastData);
    }

}
