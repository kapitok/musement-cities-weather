<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use DateTime;
use Mlozynskyy\MusementWeather\Domain\Common\DateProvider;
use Mlozynskyy\MusementWeather\Domain\Exception\DateHasAlreadyPassed;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Domain\ValueObject\Date;
use Mlozynskyy\MusementWeather\Domain\ValueObject\WeatherCondition;
use Mlozynskyy\MusementWeather\Domain\Weather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{

    /**
     * @var Weather
     */
    private Weather $weatherObject;

    public function setUp(): void
    {
        DateProvider::freeze(new DateTime('2020-09-20'));

        $this->weatherObject = new Weather(
            new Coordinates(52.37, 4.9)
        );
    }

    public function tearDown(): void
    {
        DateProvider::release();
    }

    public function testGettingCoordinatesIsWorkingProperly(): void
    {
        $this->assertInstanceOf(Coordinates::class, $this->weatherObject->getCoordinates());
        $this->assertEquals(52.37, $this->weatherObject->getCoordinates()->getLatitude());
        $this->assertEquals(4.9, $this->weatherObject->getCoordinates()->getLongitude());
    }

    public function testGettingForecastIsWorkingProperly(): void
    {
        $this->weatherObject->addDay(
            Date::fromString('2020-09-20'),
            WeatherCondition::fromString('Partly cloudy')
        );
        $this->weatherObject->addDay(
            Date::fromString('2020-09-21'),
            WeatherCondition::fromString('Patchy rain possible')
        );

        $result1 = $this->weatherObject->getConditionByDate(Date::fromString('2020-09-20'));
        $result2 = $this->weatherObject->getConditionByDate(Date::fromString('2020-09-21'));
        $nonexistentForecast = $this->weatherObject->getConditionByDate(Date::fromString('2020-09-22'));

        $this->assertInstanceOf(WeatherCondition::class, $result1);
        $this->assertInstanceOf(WeatherCondition::class, $result2);
        $this->assertEquals('Partly cloudy', $result1->toString());
        $this->assertEquals('Patchy rain possible', $result2->toString());
        $this->assertTrue(WeatherCondition::empty()->isEqual($nonexistentForecast));
    }

    public function testAddingDayForecastIsWorkingProperlyWithInvalidData(): void
    {
        $this->expectException(DateHasAlreadyPassed::class);

        $this->weatherObject->addDay(
            Date::fromString('2020-09-19'),
            WeatherCondition::fromString('Partly cloudy')
        );
    }

}
