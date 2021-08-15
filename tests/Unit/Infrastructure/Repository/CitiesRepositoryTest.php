<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Repository;

use Mlozynskyy\MusementWeather\Infrastructure\Repository\CitiesRepository;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\RestClientInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CitiesRepositoryTest
 *
 * @package Tests\Unit\Infrastructure\Repository
 */
class CitiesRepositoryTest extends TestCase
{

    public function testRepositoryIsWorkingProperly(): void
    {
        $cityResponse1 = $this->createMock(CityResponse::class);
        $cityResponse2 = $this->createMock(CityResponse::class);

        $restClientMock = $this->createConfiguredMock(RestClientInterface::class, [
            'getCities' => [$cityResponse1, $cityResponse2],
        ]);

        $citiesRepository = new CitiesRepository($restClientMock);
        $result = $citiesRepository->getList();

        $this->assertCount(2, $result);
    }

}
