<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit\Api;

use Http\Discovery\ClassDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Http\Mock\Client;
use OpenDaje\UmWa\HttpClient\Builder;
use OpenDaje\UmWa\Options;
use OpenDaje\UmWa\UltraMsgClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

/**
 * @covers \OpenDaje\UmWa\Api\Contacts
 */
class ContactTest extends TestCase
{
    private ClientInterface $mockClient;

    private UltraMsgClient $ultraMsgClient;

    protected function setUp(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $this->mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $this->mockClient),
        ]);
        $this->ultraMsgClient = new UltraMsgClient($options);
    }

    public function testGetContacts(): void
    {
        $this->ultraMsgClient->api('contacts')->getContacts();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetContactsIds(): void
    {
        $this->ultraMsgClient->api('contacts')->getContactsIds();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/ids', $this->mockClient->getLastRequest()->getUri()->getPath());

        $this->ultraMsgClient->api('contacts')->getContactsIds(true);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/ids', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetContactInfo(): void
    {
        $this->ultraMsgClient->api('contacts')->getContactInfo('123456789');

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/contact', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetBlockedContacts(): void
    {
        $this->ultraMsgClient->api('contacts')->getBlockedContacts();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/blocked', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetInvalidContacts(): void
    {
        $this->ultraMsgClient->api('contacts')->getInvalidContacts();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/invalid', $this->mockClient->getLastRequest()->getUri()->getPath());

        $this->ultraMsgClient->api('contacts')->getInvalidContacts(true);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/invalid', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testCheckContact(): void
    {
        $this->ultraMsgClient->api('contacts')->checkContact('123456789');

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/check', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&nocache=0&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());

        $this->ultraMsgClient->api('contacts')->checkContact('123456789', true);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/check', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&nocache=1&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testContactImage(): void
    {
        $this->ultraMsgClient->api('contacts')->getContactImage('123456789');

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/image', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testBlockContact(): void
    {
        $this->ultraMsgClient->api('contacts')->block('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/block', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testUnblockContact(): void
    {
        $this->ultraMsgClient->api('contacts')->unblock('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/contacts/unblock', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }
}
