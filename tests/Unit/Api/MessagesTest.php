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
 * @covers \OpenDaje\UmWa\Api\Messages
 */
class MessagesTest extends TestCase
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

    public function testGetMessages(): void
    {
        $this->ultraMsgClient->api('messages')->getMessages();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'id=&referenceId=&from=&to=&ack=&status=all&page=1&limit=100&sort=asc&token=my-token',
            $this->mockClient->getLastRequest()->getUri()->getQuery()
        );

        $this->ultraMsgClient->api('messages')->getMessages(
            '123456789',
            'referenceId',
            'from',
            'to',
            'ack',
            'status',
            5,
            200,
            'desc'
        );

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'id=123456789&referenceId=referenceId&from=from&to=to&ack=ack&status=status&page=5&limit=200&sort=desc&token=my-token',
            $this->mockClient->getLastRequest()->getUri()->getQuery()
        );
    }

    public function testGetStatistics(): void
    {
        $this->ultraMsgClient->api('messages')->getStatistics();

        self::assertEquals('GET', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/statistics', $this->mockClient->getLastRequest()->getUri()->getPath());
    }

    public function testSendChatMessages(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendChatMessage('123456789', 'Hello world...!!');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/chat', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&body=Hello+world...%21%21&priority=10&referenceId=&msgId=&mentions=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendImageMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendImageMessage('123456789', 'foo.jpeg');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/image', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&image=foo.jpeg&caption=&priority=10&referenceId=&nocache=0&msgId=&mentions=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendStickerMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendStickerMessage('123456789', 'sticker');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/sticker', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&sticker=sticker&priority=10&referenceId=&nocache=0&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendDocumentMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendDocumentMessage('123456789', 'my-file.txt', 'document');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/document', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&filename=my-file.txt&document=document&caption=&priority=10&referenceId=&nocache=0&msgId=&mentions=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendAudioMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendAudioMessage('123456789', 'my-file.mp3');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/audio', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&audio=my-file.mp3&priority=10&referenceId=&nocache=0&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendVoiceMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendVoiceMessage('123456789', 'my-file.mp3');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/voice', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&audio=my-file.mp3&priority=10&referenceId=&nocache=0&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendVideoMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendVideoMessage('123456789', 'my-file.mpeg');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/video', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&video=my-file.mpeg&caption=&priority=10&referenceId=&nocache=0&msgId=&mentions=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendContact(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendContact('123456789', 'foo-contact');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/contact', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&contact=foo-contact&priority=10&referenceId=&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendLocation(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendLocation('123456789', 'address-string', 25.197197, 55.2721877);

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/location', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&address=address-string&lat=25.197197&lng=55.2721877&priority=10&referenceId=&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendVcard(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendVcard('123456789', 'vcard-string');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/vcard', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&to=123456789&vcard=vcard-string&priority=10&referenceId=&msgId=',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testSendReaction(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->sendReaction('123456789', '🤣');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/reaction', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&msgId=123456789&emoji=%F0%9F%A4%A3',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testDeleteMessage(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->deleteMessage('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/delete', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&msgId=123456789',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testResendByStatus(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->resendByStatus('unsent');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/resendByStatus', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&status=unsent',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testResendById(): void
    {
        /** TODO: test all params */
        $this->ultraMsgClient->api('messages')->resendById('123456789');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/resendById', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals(
            'token=my-token&id=123456789',
            ($this->mockClient->getLastRequest()->getBody())->getContents()
        );
    }

    public function testClear(): void
    {
        $this->ultraMsgClient->api('messages')->clear('queue');

        self::assertEquals('POST', $this->mockClient->getLastRequest()->getMethod());
        self::assertEquals('/my-instance-id/messages/clear', $this->mockClient->getLastRequest()->getUri()->getPath());
        self::assertEquals('token=my-token&status=queue', ($this->mockClient->getLastRequest()->getBody())->getContents());
    }
}
