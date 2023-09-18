<?php declare(strict_types=1);

namespace OpenDaje\UmWa\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Authentication\Matching;
use Http\Message\Authentication\QueryParam;
use OpenDaje\UmWa\Options;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class Builder
{
    private ClientInterface $httpClient;

    private StreamFactoryInterface $streamFactory;

    private RequestFactoryInterface $requestFactory;

    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    public function getHttpClient(Options $options): HttpMethodsClientInterface
    {
        $authenticationWithTokenInQueryParam = new QueryParam([
            'token' => $options->getToken(),
        ]);

        $authentication = new Matching(
            $authenticationWithTokenInQueryParam,
            fn (RequestInterface $request) => 'GET' === $request->getMethod()
        );

        $httpClientPlugins = [
            new AuthenticationPlugin($authentication),
            new AddHostPlugin($options->getUri()),
            new HeaderDefaultsPlugin([
                'User-Agent' => 'od-ultramsg-php-client (https://github.com/OpenDaje/ultramsg-client)',
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]),
        ];

        return new HttpMethodsClient(
            (new PluginClientFactory())->createClient($this->httpClient, $httpClientPlugins),
            $this->requestFactory,
            $this->streamFactory
        );
    }
}
