# PHP UltraMsg Client
#### *Easy whatsApp integration in your applications*

[![CD/CI](https://github.com/OpenDaje/ultramsg-client/actions/workflows/cd-ci.yaml/badge.svg)](https://github.com/OpenDaje/ultramsg-client/actions/workflows/cd-ci.yaml)
[![PHP Version Require](https://poser.pugx.org/opendaje/ultramsg-client/require/php)](https://packagist.org/packages/opendaje/ultramsg-client)
[![Latest Stable Version](https://poser.pugx.org/opendaje/ultramsg-client/v)](https://packagist.org/packages/opendaje/ultramsg-client)
[![License](https://poser.pugx.org/opendaje/ultramsg-client/license)](https://packagist.org/packages/opendaje/ultramsg-client)
[![Total Downloads](https://poser.pugx.org/opendaje/ultramsg-client/downloads)](https://packagist.org/packages/opendaje/ultramsg-client)
[![Latest Unstable Version](https://poser.pugx.org/opendaje/ultramsg-client/v/unstable)](https://packagist.org/packages/opendaje/ultramsg-client)

⚠  Launching early stage releases (0.x.x) could break the API according to [Semantic Versioning 2.0](https://semver.org/). We are using *minor* for breaking changes.
This will change with the release of the stable `1.0.0` version.

## Requirements

* PHP >= 8.0
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## About UltraMsg
- [Website](https://ultramsg.com)
- [Api docs](https://docs.ultramsg.com/)
- [Official client](https://github.com/ultramsg/whatsapp-php-sdk)

## Quick install

Via [Composer](https://getcomposer.org).

This package is not tied to any specific library that sends HTTP messages. Instead, it uses Httplug to let users choose whichever PSR-7 implementation and HTTP client they want to use.

If you just want to get started quickly you should run the following command:

```bash
composer require opendaje/ultramsg-client symfony/http-client nyholm/psr7
```

This will install the library itself along with a symfony HTTP client adapter. You do not have to use those packages if you do not want to. The package does not care about which transport method you want to use because it's an implementation detail of your application. You may use any package that provides http-message-implementation.

Other [available](https://docs.php-http.org/en/latest/clients.html) HTTP Clients


## Example
```php
...

$options = new Options([
            'token' => 'MY_TOKEN',
            'instanceId' => 'MY_INSTANCE_ID',
]);

$client = new UltraMsgClient($options);

// see src/Api/Messages methods
$client->api('messages')->sendChatMessage('555-555-555', 'Hello!!!');

// see src/Api/Groups methods
$client->api('groups')->getGroups();

```
