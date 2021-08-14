<?php
declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Infrastructure\Rest;

use Exception;

/**
 * Class ApiException
 * @package Mlozynskyy\MusementWeather\Infrastructure\Rest
 */
class ApiException extends Exception
{
    /**
     * @param string $uri
     * @return static
     */
    public static function with(string $uri): self
    {
        return new self(sprintf('[Api problem] uri: %s', $uri));
    }
}
