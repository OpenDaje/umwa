<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit\Api;

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Http\Mock\Client;
use OpenDaje\UmWa\HttpClient\Builder;
use OpenDaje\UmWa\Options;
use OpenDaje\UmWa\UltraMsgClient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpenDaje\UmWa\Api\Contacts
 */
class ContactTest extends TestCase
{
    public function testGetContacts(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getContacts();

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts', $mockClient->getLastRequest()->getUri()->getPath());
    }
}
