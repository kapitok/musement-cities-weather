<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Repository;

use Mlozynskyy\MusementWeather\Application\Repository\CitiesRepositoryInterface;
use Mlozynskyy\MusementWeather\Domain\City;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\RestClientInterface;

/**
 * Class CitiesRepository
 *
 * @package Mlozynskyy\MusementWeather\Infrastructure\Repository
 */
class CitiesRepository implements CitiesRepositoryInterface
{

    /**
     * @var RestClientInterface
     */
    private RestClientInterface $restClient;

    /**
     * CitiesRepository constructor.
     *
     * @param RestClientInterface $restClient
     */
    public function __construct(RestClientInterface $restClient)
    {
        $this->restClient = $restClient;
    }

    /**
     * @return array<City>
     */
    public function getList(): array
    {
        $cities = $this->restClient->getCities();

        return array_map(static function (CityResponse $city) {
            return new City(
                $city->getCityId(),
                $city->getName(),
                new Coordinates(
                    $city->getLatitude(),
                    $city->getLatitude()
                )
            );
        }, $cities);
    }

}
