<?php declare(strict_types=1);

namespace OpenDaje\UmWa;

use Http\Client\Common\HttpMethodsClientInterface;
use OpenDaje\UmWa\Api\AbstractApi;
use OpenDaje\UmWa\Exception\InvalidArgumentException;
use OpenDaje\UmWa\HttpClient\Builder;

class UltraMsgClient
{
    private Builder $httpClientBuilder;

    private Options $options;

    public function __construct(Options $options = null)
    {
        $this->options = $options ?? new Options();

        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
    }

    /**
     * @throws InvalidArgumentException
     */
    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'chats' => new Api\Chats($this),
            'groups' => new Api\Groups($this),
            'instance', 'device' => new Api\Instance($this),
            'media' => new Api\Media($this),
            'messages' => new Api\Messages($this),

            default => throw new InvalidArgumentException(
                sprintf('Undefined api instance called: "%s"', $name)
            ),
        };
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient($this->options);
    }

    public function getOptions(): Options
    {
        return $this->options;
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
