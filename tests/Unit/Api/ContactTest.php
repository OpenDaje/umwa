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

    public function testGetContactsIds(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getContactsIds();

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/ids', $mockClient->getLastRequest()->getUri()->getPath());

        $sut->api('contacts')->getContactsIds(true);

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/ids', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetContactInfo(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getContactInfo('123456789');

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/contact', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&token=my-token', $mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetBlockedContacts(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getBlockedContacts();

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/blocked', $mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetInvalidContacts(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getInvalidContacts();

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/invalid', $mockClient->getLastRequest()->getUri()->getPath());

        $sut->api('contacts')->getInvalidContacts(true);

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/invalid', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testCheckContact(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->checkContact('123456789');

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/check', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&nocache=0&token=my-token', $mockClient->getLastRequest()->getUri()->getQuery());

        $sut->api('contacts')->checkContact('123456789', true);

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/check', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&nocache=1&token=my-token', $mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testContactImage(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->getContactImage('123456789');

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/image', $mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testBlockContact(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->block('123456789');

        self::assertEquals('POST', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/block', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testUnblockContact(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('contacts')->unblock('123456789');

        self::assertEquals('POST', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/unblock', $mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($mockClient->getLastRequest()->getBody())->getContents());
    }
}
