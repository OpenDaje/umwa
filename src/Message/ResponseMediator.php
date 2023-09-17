<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = $response->getBody()->__toString();
        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return (array) $content;
            }
        }

        return $body;
    }

    /**
     * @return array<string,string>
     */
    public static function getPagination(ResponseInterface $response): array
    {
        $header = self::getHeader($response, 'Link');

        if (null === $header) {
            return [];
        }

        $pagination = [];
        foreach (explode(',', $header) as $link) {
            preg_match('/<(.*)>; rel="(.*)"/i', trim($link, ','), $match);

            /** @var string[] $match */
            if (3 === \count($match)) {
                $pagination[$match[2]] = $match[1];
            }
        }

        return $pagination;
    }

    /**
     * Get the value for a single header.
     */
    public static function getHeader(ResponseInterface $response, string $name): ?string
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
