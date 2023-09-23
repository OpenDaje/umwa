<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit;

use Http\Client\Common\HttpMethodsClientInterface;
use OpenDaje\UmWa\Options;
use OpenDaje\UmWa\UltraMsgClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

/**
 * @covers \OpenDaje\UmWa\UltraMsgClient
 */
class UltraMsgClientTest extends TestCase
{
    public function testName(): void
    {
        $options = new Options([
            'token' => 'xxxx',
            'instanceId' => 'xxxx',
        ]);

        $sut = new UltraMsgClient($options);

        self::assertInstanceOf(ClientInterface::class, $sut->getHttpClient());
        self::assertInstanceOf(HttpMethodsClientInterface::class, $sut->getHttpClient());
    }
}
