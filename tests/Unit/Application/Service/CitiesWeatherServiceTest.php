<?php

declare(strict_types=1);

namespace Tests\Unit\Application\ReadModel;

use Mlozynskyy\MusementWeather\Application\ReadModel\CityWeather;
use Mlozynskyy\MusementWeather\Application\Repository\CitiesRepositoryInterface;
use Mlozynskyy\MusementWeather\Application\Repository\WeatherRepositoryInterface;
use Mlozynskyy\MusementWeather\Application\Service\CitiesWeatherService;
use Mlozynskyy\MusementWeather\Domain\City;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\Weather;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CitiesWeatherServiceTest extends TestCase
{

    public function testServiceIsWorkingProperly(): void
    {
        $citiesRepositoryMock = $this->getCitiesRepositoryMock();
        $citiesRepositoryMock->expects($this->once())->method('getList');

        $weatherRepositoryMock = $this->createConfiguredMock(WeatherRepositoryInterface::class, [
            'getByCoordinates' => $this->createMock(Weather::class),
        ]);

        $weatherRepositoryMock->expects($this->once())
            ->method('getByCoordinates')
            ->withConsecutive([
                $this->isInstanceOf(Coordinates::class),
                $this->equalTo(2),
            ]);

        $service = new CitiesWeatherService($citiesRepositoryMock, $weatherRepositoryMock);

        $result = $service->getCitiesWeather();

        $this->assertCount(1, $result);
        $this->assertInstanceOf(CityWeather::class, $result[0]);
    }

    /**
     * @return CitiesRepositoryInterface|MockObject
     */
    protected function getCitiesRepositoryMock(): MockObject
    {
        $cityMock1 = $this->createMock(City::class);
        $cityMock1->expects($this->once())
            ->method('getCoordinates');

        return $this->createConfiguredMock(CitiesRepositoryInterface::class, [
            'getList' => [$cityMock1],
        ]);
    }

}
