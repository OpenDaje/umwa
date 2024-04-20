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
 * @covers \OpenDaje\UmWa\Api\Media
 */
class MediaTest extends TestCase
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

    public function testUpload(): void
    {
        self::markTestIncomplete('Test with fixtures file');
        $this->ultraMsgClient->api('media')->upload('foo.xml');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/media/upload', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&file=foo.xml', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testDeleteMedia(): void
    {
        $this->ultraMsgClient->api('media')->deleteMedia('https://example.com/foo.xml');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/media/delete', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&url=https%3A%2F%2Fexample.com%2Ffoo.xml', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testDeleteByDate(): void
    {
        $this->ultraMsgClient->api('media')->deleteByDate('1-2023');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/media/deleteByDate', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&date=1-2023', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }
}
