<?php declare(strict_types=1);

namespace OpenDaje\UmWa;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Configuration container for the UltraMsg client.
 */
class Options
{
    /**
     * @var array<string, mixed> The configuration options
     */
    private array $options;

    private OptionsResolver $resolver;

    /**
     * Class constructor.
     *
     * @param array<string, mixed> $options The configuration options
     */
    public function __construct(array $options = [])
    {
        $this->resolver = new OptionsResolver();

        $this->configureOptions($this->resolver);

        $this->options = $this->resolver->resolve($options);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'token' => null,
            'instanceId' => null,
            'uri' => 'https://api.ultramsg.com',
            'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
        ]);

        $resolver->setAllowedTypes('token', 'string');
        $resolver->setAllowedTypes('instanceId', 'string');
        $resolver->setAllowedTypes('uri', 'string');
        $resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
    }

    public function getToken(): string
    {
        return $this->options['token'];
    }

    public function getInstanceId(): string
    {
        return $this->options['instanceId'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri((string) $this->options['uri']);
    }

    private function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }
}
