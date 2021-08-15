<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Date;
use Mlozynskyy\MusementWeather\Infrastructure\Repository\WeatherRepository;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\RestClientInterface;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response\WeatherResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class WeatherRepositoryTest
 *
 * @package Tests\Unit\Infrastructure\Repository
 */
class WeatherRepositoryTest extends TestCase
{

    public function testRepositoryIsWorkingProperly(): void
    {
        $restClientMock = $this->getRestClientMock();
        $restClientMock
            ->expects($this->once())
            ->method('getWeatherByCoordinates')
            ->with(...[
               $this->isInstanceOf(Coordinates::class),
               $this->equalTo(2),
            ]);

        $weatherRepository = new WeatherRepository($restClientMock);
        $result = $weatherRepository->getByCoordinates(new Coordinates(48.866, 2.355), 2);

        $this->assertEquals(
            'Partly cloudy',
            $result->getConditionByDate(Date::fromString('2021-09-14'))->toString()
        );
        $this->assertEquals(
            'Patchy rain possible',
            $result->getConditionByDate(Date::fromString('2021-09-15'))->toString()
        );
    }

    /**
     * @return RestClientInterface|MockObject
     */
    protected function getRestClientMock(): MockObject
    {
        return $this->createConfiguredMock(RestClientInterface::class, [
            'getWeatherByCoordinates' => $this->createConfiguredMock(WeatherResponse::class, [
                'getForecast' => [
                    ['date' => '2021-09-14', 'condition' => 'Partly cloudy'],
                    ['date' => '2021-09-15', 'condition' => 'Patchy rain possible'],
                ],
            ]),
        ]);
    }

}
