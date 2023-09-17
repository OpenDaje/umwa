<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit;

use Http\Client\Common\HttpMethodsClientInterface;
use OpenDaje\UmWa\UltraMsgClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class UltraMsgClientTest extends TestCase
{
    public function testName()
    {
        $sut = new UltraMsgClient();

        self::assertInstanceOf(ClientInterface::class, $sut->getHttpClient());
        self::assertInstanceOf(HttpMethodsClientInterface::class, $sut->getHttpClient());
    }
}
