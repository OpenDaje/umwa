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

    public function getHttpClient(): HttpMethodsClientInterface
    {
        // TODO: remove hardcoded token
        $authenticationWithTokenInQueryParam = new QueryParam([
            'token' => 'xxxxxxx',
        ]);

        $authentication = new Matching(
            $authenticationWithTokenInQueryParam,
            fn (RequestInterface $request) => 'GET' === $request->getMethod()
        );

        $httpClientPlugins = [
            new AuthenticationPlugin($authentication),
            new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.ultramsg.com/')),
            new HeaderDefaultsPlugin([
                'User-Agent' => 'open-daje-ultramsg-api/v0.0.1 (https://github.com/OpenDaje/umwa)',
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