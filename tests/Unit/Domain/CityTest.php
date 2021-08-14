<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use Mlozynskyy\MusementWeather\Domain\City;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use PHPUnit\Framework\TestCase;

/**
 * Class CityTest
 *
 * @package Tests\Unit\Domain
 */
class CityTest extends TestCase
{

    /**
     * @dataProvider provideCityData
     * @param int $cityId
     * @param string $cityName
     * @param float $latitude
     * @param float $longitude
     */
    public function testGettingDataIsWorkingProperly(
        int $cityId,
        string $cityName,
        float $latitude,
        float $longitude
    ): void {
        $cityObject = new City($cityId, $cityName, new Coordinates($latitude, $longitude));

        $this->assertEquals($cityId, $cityObject->getCityId());
        $this->assertEquals($cityName, $cityObject->getName());
        $this->assertEquals($latitude, $cityObject->getCoordinates()->getLatitude());
        $this->assertEquals($longitude, $cityObject->getCoordinates()->getLongitude());
    }

    /**
     * @return array[]
     */
    public function provideCityData(): array
    {
        return [
            [11, 'Los Angeles', 444.5, 23.2],
            [12, 'New York', 44, 23],
            [1, 'New York', 1, 1],
        ];
    }

}
