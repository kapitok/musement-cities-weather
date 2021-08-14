<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather;

use RuntimeException;

/**
 * Class ModuleConfig
 * @package Mlozynskyy\MusementWeather
 */
class ModuleConfig
{
    /**
     * @return string
     */
    public function getApiMusementBaseUri(): string
    {
        return $this->getEnv('API_MUSEMENT_URI');
    }

    /**
     * @return string
     */
    public function getApiWeatherKey(): string
    {
        return $this->getEnv('API_WEATHER_KEY');
    }

    /**
     * @return string
     */
    public function getApiWeatherBaseUri(): string
    {
        return $this->getEnv('API_WEATHER_URI');
    }

    protected function getEnv(string $name)
    {
        $value = getenv($name);

        if (false === $value) {
            throw new RuntimeException(sprintf('Env variable is required: %s', $name));
        }

        return $value;
    }
}
