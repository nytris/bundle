# Nytris Bundle

[![Build Status](https://github.com/nytris/bundle/workflows/CI/badge.svg)](https://github.com/nytris/bundle/actions?query=workflow%3ACI)

Integrates [Nytris][Nytris] packages into a [Symfony][Symfony] application via plugins.

## Usage
Install this package with Composer:

```shell
$ composer install nytris/bundle
```

## Plugins
Install one or more plugins as required:

- [Envoylope AMQP-Compat][Envoylope AMQP-Compat] for integrating [PHP AMQP-Compat][PHP AMQP-Compat] into a Symfony application.
- [Nytris Shift Symfony][Nytris Shift Symfony] for integrating [PHP Code Shift][PHP Code Shift] into a Symfony application.

See the respective READMEs for each plugin and [Nytris][Nytris] itself for configuration instructions,
but usually a Nytris Bundle plugin will automatically be registered with the Bundle itself on installation.

[Envoylope AMQP-Compat]: https://github.com/envoylope/amqp-symfony
[Nytris]: https://github.com/nytris/nytris
[Nytris Shift Symfony]: https://github.com/nytris/shift-symfony
[PHP AMQP-Compat]: https://github.com/asmblah/php-amqp-compat
[PHP Code Shift]: https://github.com/asmblah/php-code-shift
[Symfony]: https://symfony.com
