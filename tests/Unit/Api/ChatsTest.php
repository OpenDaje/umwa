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
 * @covers \OpenDaje\UmWa\Api\Chats
 */
class ChatsTest extends TestCase
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

    public function testGetChats(): void
    {
        ClassDiscovery::prependStrategy(MockClientStrategy::class);

        $mockClient = new Client();
        $options = new Options([
            'token' => 'my-token',
            'instanceId' => 'my-instance-id',
            'client_builder' => new Builder(httpClient: $mockClient),
        ]);

        $sut = new UltraMsgClient($options);

        $sut->api('chats')->getChats();

        self::assertEquals('GET', $mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats', $mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetContactsIds(): void
    {
        $this->ultraMsgClient->api('chats')->getChatsIds();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/ids', $this->mockClient->getLastRequest()->getUri()->getPath());

        $this->ultraMsgClient->api('chats')->getChatsIds(true);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/ids', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetChatMessages(): void
    {
        $this->ultraMsgClient->api('chats')->getChatMessages('123456789');

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/messages', $this->mockClient->getLastRequest()->getUri()->getPath());

        $this->ultraMsgClient->api('chats')->getChatMessages('123456789', 100);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/messages', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('chatId=123456789&limit=100&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testUrchiveChat(): void
    {
        $this->ultraMsgClient->api('chats')->unarchiveChat('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/unarchive', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testArchiveChat(): void
    {
        $this->ultraMsgClient->api('chats')->unarchiveChat('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/unarchive', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testClearChatMessages(): void
    {
        $this->ultraMsgClient->api('chats')->clearMessages('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/clearMessages', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testDeleteChat(): void
    {
        $this->ultraMsgClient->api('chats')->deleteChat('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/chats/delete', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&chatId=123456789', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }
}
