<?php declare(strict_types=1);

namespace OpenDaje\UmWa;

use Http\Client\Common\HttpMethodsClientInterface;
use OpenDaje\UmWa\Api\AbstractApi;
use OpenDaje\UmWa\Exception\InvalidArgumentException;
use OpenDaje\UmWa\HttpClient\Builder;

class UltraMsgClient
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
    }

    /**
     * @throws InvalidArgumentException
     */
    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'instance', 'device' => new Api\Instance($this),

            default => throw new InvalidArgumentException(
                sprintf('Undefined api instance called: "%s"', $name)
            ),
        };
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
