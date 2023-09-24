<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit\Api;

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Http\Mock\Client;
use OpenDaje\UmWa\HttpClient\Builder;
use OpenDaje\UmWa\Options;
use OpenDaje\UmWa\UltraMsgClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \OpenDaje\UmWa\Api\Contacts
 */
class ContactTest extends TestCase
{
    public function testGetContacts(): void
    {
        self::markTestIncomplete();
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();

        $response = $this->createMock(ResponseInterface::class);

        $mockClient->addResponse(
            $response
        );

        $options = new Options([
            'token' => 'xxxx',
            'instanceId' => 'xxxx',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);
    }
}
