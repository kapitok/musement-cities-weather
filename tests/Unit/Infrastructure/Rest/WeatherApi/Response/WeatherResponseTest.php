<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Rest\WeatherApi\Response;

use Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response\WeatherResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class WeatherResponseTest
 *
 * @package Tests\Unit\Infrastructure\Rest\WeatherApi\Response
 */
class WeatherResponseTest extends TestCase
{

    /**
     * @dataProvider forecastResponseDataProvider
     * @param array $forecastData
     * @param array $expectedForecastData
     */
    public function testResponseObjectIsWorkingProperly(array $forecastData, array $expectedForecastData): void
    {
        $response = new WeatherResponse('New York', 52.37, 4.9, $forecastData);

        $this->assertEquals(52.37, $response->getLatitude());
        $this->assertEquals(4.9, $response->getLongitude());
        $this->assertEquals($expectedForecastData, $response->getForecast());
    }

    /**
     * @return array
     */
    // @codingStandardsIgnoreLine
    public function forecastResponseDataProvider(): array
    {
        return [
            [ [], [] ],
            [
                [ ['date' => '2021-08-14', 'day' => ['condition' => ['text' => 'Partly Cloudly']]] ],
                [ ['date' => '2021-08-14', 'condition' => 'Partly Cloudly'] ],
            ],
            [
                [ ['date' => '2021-08-14', 'day' => ['condition' => ['text' => null]]] ],
                [ ['date' => '2021-08-14', 'condition' => ''] ],
            ],
            [
                [ ['date' => '2021-08-14', 'day' => ['condition' => null]] ],
                [ ['date' => '2021-08-14', 'condition' => ''] ],
            ],
            [
                [ ['date' => '2021-08-14', 'day' => null] ],
                [ ['date' => '2021-08-14', 'condition' => ''] ],
            ],
            [
                [ ['date' => '2021-08-14'] ],
                [ ['date' => '2021-08-14', 'condition' => ''] ],
            ],
        ];
    }

}
