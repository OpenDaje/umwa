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
 * @covers \OpenDaje\UmWa\Api\Groups
 */
class GroupsTest extends TestCase
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

    public function testGetGroups(): void
    {
        $this->ultraMsgClient->api('groups')->getGroups();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/groups', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetGroupsIds(): void
    {
        $this->ultraMsgClient->api('groups')->getGroupsIds();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/groups/ids', $this->mockClient->getLastRequest()->getUri()->getPath());

        $this->ultraMsgClient->api('groups')->getGroupsIds(true);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/groups/ids', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('clear=1&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testGetGroupsInfo(): void
    {
        $this->ultraMsgClient->api('groups')->getGroupInfo('123456789');

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/groups/group', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('groupId=123456789&priority=5&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());

        $this->ultraMsgClient->api('groups')->getGroupInfo('123456789', 50);

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/groups/group', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('groupId=123456789&priority=50&token=my-token', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }
}
