<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit\HttpClient;

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Http\Mock\Client;
use OpenDaje\UmWa\HttpClient\Builder;
use OpenDaje\UmWa\Options;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

/**
 * @covers \OpenDaje\UmWa\HttpClient\Builder
 */
class BuilderTest extends TestCase
{
    public function testShouldBeCreatedWithDefaultValues(): void
    {
        $options = new Options([
            'token' => 'xxxx',
            'instanceId' => 'xxxx',
        ]);

        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();

        $builder = new Builder($mockClient, $requestFactory, $streamFactory);

        $request = Psr17FactoryDiscovery::findRequestFactory()
            ->createRequest('POST', 'https://example.com/example/resource')
            ->withBody($streamFactory->createStream('foo bar'));

        $httpClient = $builder->getHttpClient($options);

        $httpClient->sendRequest($request);

        /** @var RequestInterface $httpRequest */
        $httpRequest = $mockClient->getLastRequest();

        self::assertInstanceOf(ClientInterface::class, $builder->getHttpClient($options));
        self::assertSame('https://example.com/example/resource', $httpRequest->getUri()->__toString());
        self::assertSame('od-ultramsg-php-client (https://github.com/OpenDaje/ultramsg-client)', $httpRequest->getHeaderLine('User-Agent'));
        self::assertSame('application/x-www-form-urlencoded', $httpRequest->getHeaderLine('Content-type'));
    }
}
