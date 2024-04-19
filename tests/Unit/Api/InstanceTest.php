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
 * @covers \OpenDaje\UmWa\Api\Instance
 */
class InstanceTest extends TestCase
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

    public function testGetStatus(): void
    {
        $this->ultraMsgClient->api('instance')->getStatus();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/status', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetSettings(): void
    {
        $this->ultraMsgClient->api('instance')->getSettings();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/settings', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetQr(): void
    {
        $this->ultraMsgClient->api('instance')->getQR();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/qr', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetQrCode(): void
    {
        $this->ultraMsgClient->api('instance')->getQrCode();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/qrCode', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testGetConnectedPhoneInfo(): void
    {
        $this->ultraMsgClient->api('instance')->getConnectedPhoneInfo();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/me', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testlogout(): void
    {
        $this->ultraMsgClient->api('instance')->logout();

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/logout', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testRestart(): void
    {
        $this->ultraMsgClient->api('instance')->restart();

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/restart', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }

    public function testSettings(): void
    {
        $this->ultraMsgClient->api('instance')->settings();

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/settings', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&sendDelay=1&webhook_url=&webhook_message_received=&webhook_message_create=&webhook_message_ack=&webhook_message_download_media=', ($this->mockClient->getLastRequest()->getBody())->getContents());

        $this->ultraMsgClient->api('instance')->settings(
            5,
            'https://example.com/webhook',
            'webhook_message_received',
            'webhook_message_create',
            'webhook_message_ack',
            'webhook_message_download_media'
        );

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/settings', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&sendDelay=5&webhook_url=https%3A%2F%2Fexample.com%2Fwebhook&webhook_message_received=webhook_message_received&webhook_message_create=webhook_message_create&webhook_message_ack=webhook_message_ack&webhook_message_download_media=webhook_message_download_media',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testClear(): void
    {
        $this->ultraMsgClient->api('instance')->clear();

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/instance/clear', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }
}
