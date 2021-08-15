<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Rest\MusementApi\Response;

use Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class CityResponseTest
 *
 * @package Tests\Unit\Infrastructure\Rest\MusementApi\Response
 */
class CityResponseTest extends TestCase
{

    public function testResponseObjectIsWorkingProperly(): void
    {
        $cityResponse = new CityResponse(111, 'CityName', 52.37, 4.9);

        $this->assertEquals('CityName', $cityResponse->getName());
        $this->assertEquals(111, $cityResponse->getCityId());
        $this->assertEquals(52.37, $cityResponse->getLatitude());
        $this->assertEquals(4.9, $cityResponse->getLongitude());
    }

}
