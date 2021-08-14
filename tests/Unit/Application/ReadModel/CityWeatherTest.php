<?php

declare(strict_types=1);

namespace Tests\Unit\Application\ReadModel;

use Mlozynskyy\MusementWeather\Application\ReadModel\CityWeather;
use Mlozynskyy\MusementWeather\Domain\City;
use Mlozynskyy\MusementWeather\Domain\ValueObject\WeatherCondition;
use Mlozynskyy\MusementWeather\Domain\Weather;
use PHPUnit\Framework\TestCase;

class CityWeatherTest extends TestCase
{

    public function testReadModelIsWorkingProperly(): void
    {
        $cityMock = $this->createConfiguredMock(City::class, [
            'getName' => 'City Name',
        ]);
        $weatherMock = $this->createConfiguredMock(Weather::class, [
            'getTodayCondition' => $this->createConfiguredMock(WeatherCondition::class, [
                'toString' => 'Heavy rain',
            ]),
            'getTomorrowCondition' => $this->createConfiguredMock(WeatherCondition::class, [
                'toString' => 'Partly cloudy',
            ]),
        ]);

        $readModel = new CityWeather($cityMock, $weatherMock);

        $this->assertEquals('City Name', $readModel->getCityName());
        $this->assertEquals('Heavy rain', $readModel->getTodayCondition());
        $this->assertEquals('Partly cloudy', $readModel->getTomorrowCondition());
    }

}
