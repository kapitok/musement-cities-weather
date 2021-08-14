<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Application\Service;

use Mlozynskyy\MusementWeather\Application\ReadModel\CityWeather;
use Mlozynskyy\MusementWeather\Application\Repository\CitiesRepositoryInterface;
use Mlozynskyy\MusementWeather\Application\Repository\WeatherRepositoryInterface;

/**
 * Class CitiesWeatherService
 *
 * @package Mlozynskyy\MusementWeather\Application\Service
 */
class CitiesWeatherService
{

    private const FORECAST_FOR_DAYS = 2;

    /** @var CitiesRepositoryInterface */
    private CitiesRepositoryInterface $citiesRepository;

    /** @var WeatherRepositoryInterface */
    private WeatherRepositoryInterface $weatherRepository;

    /**
     * CitiesWeatherService constructor.
     *
     * @param CitiesRepositoryInterface $citiesRepository
     * @param WeatherRepositoryInterface $weatherRepository
     */
    public function __construct(
        CitiesRepositoryInterface $citiesRepository,
        WeatherRepositoryInterface $weatherRepository
    ) {
        $this->citiesRepository = $citiesRepository;
        $this->weatherRepository = $weatherRepository;
    }

    /**
     * @return array<CityWeather>
     */
    public function getCitiesWeather(): array
    {
        $cities = $this->citiesRepository->getList();
        $readModels = [];

        foreach ($cities as $city) {
            $weather = $this->weatherRepository
                ->getByCoordinates($city->getCoordinates(), self::FORECAST_FOR_DAYS);

            $readModels[] = new CityWeather($city, $weather);
        }

        return $readModels;
    }

}
