<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest;

use Mlozynskyy\MusementWeather\Domain\ValueObject\Coordinates;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\MusementApi\Response\CityResponse;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\WeatherApi\Response\WeatherResponse;
use Mlozynskyy\MusementWeather\ModuleConfig;
use Nette\Utils\Arrays;
use RuntimeException;
use Throwable;

/**
 * Class Client
 * @package Mlozynskyy\MusementWeather\Infrastructure\Rest
 */
class Client implements RestClientInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private \GuzzleHttp\Client $httpClient;

    /**
     * @var ModuleConfig
     */
    private ModuleConfig $moduleConfig;

    /**
     * Client constructor.
     *
     * @param ModuleConfig $moduleConfig
     */
    public function __construct(ModuleConfig $moduleConfig)
    {
        $this->moduleConfig = $moduleConfig;
        //TODO: Use factory for instantiating
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * @return CityResponse[]
     */
    public function getCities(): array
    {
        $response = $this->get(
            sprintf(
                '%s/api/v3/cities',
                $this->moduleConfig->getApiMusementBaseUri()
            )
        );

        return array_map(static function (array $cityData) {
            return new CityResponse(
                $cityData['id'],
                $cityData['name'],
                $cityData['latitude'],
                $cityData['longitude']
            );
        }, $response);
    }

    /**
     * @param Coordinates $coordinates
     * @param $days
     * @return WeatherResponse
     * @throws ApiException
     */
    public function getWeatherByCoordinates(Coordinates $coordinates, $days): WeatherResponse
    {
        $uri = sprintf(
            '%s/v1/forecast.json',
            $this->moduleConfig->getApiWeatherBaseUri()
        );

        $options = [
            'query' => [
                'key' => $this->moduleConfig->getApiWeatherKey(),
                'q' => sprintf(
                    '%d,%d',
                    $coordinates->getLatitude(),
                    $coordinates->getLongitude()
                ),
                'days' => $days
            ]
        ];

        $response = $this->get($uri, $options);

        return new WeatherResponse(
            Arrays::get($response, ['location', 'name']),
            (float) Arrays::get($response, ['location', 'lat']),
            (float) Arrays::get($response, ['location', 'lon']),
            Arrays::get($response, ['forecast', 'forecastday'])
        );
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     * @throws ApiException
     */
    protected function get(string $uri, array $options = []): array
    {
        try {
            $response = $this->httpClient
                ->get($uri, $options);
        } catch (Throwable $e) {
            throw ApiException::with($uri);
        }

        if (!$this->isSuccess($response->getStatusCode())) {
            throw ApiException::with($uri);
        }

        $body = $response->getBody()
            ->getContents();

        return $this->decodeResponse($body);
    }

    /**
     * @param string $response
     * @return array
     */
    protected function decodeResponse(string $response): array
    {
        $decodedData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Decoding Error');
        }

        return $decodedData;
    }

    /**
     * @param int $statusCode
     * @return bool
     */
    protected function isSuccess(int $statusCode): bool
    {
        return (200 <= $statusCode && 300 > $statusCode);
    }
}
