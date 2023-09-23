<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Tests\Unit;

use Http\Discovery\Psr17FactoryDiscovery;
use OpenDaje\UmWa\HttpClient\Builder;
use OpenDaje\UmWa\Options;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * @covers \OpenDaje\UmWa\Options
 */
class OptionTest extends TestCase
{
    public function testShouldFailWhenTokenIsMissing(): void
    {
        self::expectException(InvalidOptionsException::class);
        self::expectExceptionMessage('The option "token" with value null is expected to be of type "string", but is of type "null".');

        new Options();
    }

    public function testShouldFailWhenInstanceIdIsMissing(): void
    {
        self::expectException(InvalidOptionsException::class);
        self::expectExceptionMessage('The option "instanceId" with value null is expected to be of type "string", but is of type "null".');

        new Options([
            'token' => 'irrelevant',
        ]);
    }

    public function testShouldHaveATokenOptionSet(): void
    {
        $clientOptions = new Options([
            'token' => 'irrelevant_token',
            'instanceId' => 'irrelevant_instance_id',
        ]);

        self::assertNotEmpty($clientOptions->getToken());
        self::assertEquals('irrelevant_token', $clientOptions->getToken());
    }

    public function testShouldHaveAnInstanceIdOptionSet(): void
    {
        $clientOptions = new Options([
            'token' => 'irrelevant_token',
            'instanceId' => 'irrelevant_instance_id',
        ]);

        self::assertNotEmpty($clientOptions->getInstanceId());
        self::assertEquals('irrelevant_instance_id', $clientOptions->getInstanceId());
    }

    public function testShouldHaveADefaultUriParamSet(): void
    {
        $expectedUri = Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.ultramsg.com');
        $clientOptions = new Options([
            'token' => 'irrelevant_token',
            'instanceId' => 'irrelevant_instance_id',
        ]);

        self::assertEquals($expectedUri, $clientOptions->getUri());
    }

    public function testShouldHaveADefaultClientBuilderSet(): void
    {
        $clientOptions = new Options([
            'token' => 'irrelevant_token',
            'instanceId' => 'irrelevant_instance_id',
        ]);

        self::assertInstanceOf(Builder::class, $clientOptions->getClientBuilder());
    }
}
