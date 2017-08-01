# LaravelLoggerProvider

[![Software license][ico-license]](LICENSE)
[![Latest stable][ico-version-stable]][link-packagist]
[![Monthly installs][ico-downloads-monthly]][link-downloads]
[![Travis][ico-travis]][link-travis]

A laravel and lumen service provider for logging.

## Main features
- Stream
- Logstash

## Installation

### Composer
> composer require triadev/laravel-logger-provider

### Application
Register the service provider in the config/app.php (Laravel) or in the bootstrap/app.php (Lumen).
```
'providers' => [
    \Triadev\Logger\Provider\LoggerServiceProvider::class
]
```

Once installed you can now publish your config file and set your correct configuration for using the package.
```php
php artisan vendor:publish --provider="Triadev\Logger\Provider\LoggerServiceProvider" --tag="config"
```

This will create a file ```config/sc-logger.php```.

## Configuration
| Key        | Value           | Description  |
|:-------------:|:-------------:|:-----:|
| LOG_TYPE | STRING | stream or logstash |
| LOG_STREAM | STRING | php://stdout, ... |
| LOG_LEVEL | STRING | debug,error, ... |

## Reporting Issues
If you do find an issue, please feel free to report it with GitHub's bug tracker for this project.

Alternatively, fork the project and make a pull request. :)

## Other

### Project related links
- [Wiki](https://github.com/triadev/LaravelLoggerProvider/wiki)
- [Issue tracker](https://github.com/triadev/LaravelLoggerProvider/issues)

### Author
- [Christopher Lorke](mailto:christopher.lorke@gmx.de)

### License
The code for LaravelLoggerProvider is distributed under the terms of the MIT license (see [LICENSE](LICENSE)).

[ico-license]: https://img.shields.io/github/license/triadev/LaravelLoggerProvider.svg?style=flat-square
[ico-version-stable]: https://img.shields.io/packagist/v/triadev/laravel-logger-provider.svg?style=flat-square
[ico-downloads-monthly]: https://img.shields.io/packagist/dm/triadev/laravel-logger-provider.svg?style=flat-square
[ico-travis]: https://travis-ci.org/triadev/LaravelLoggerProvider.svg?branch=master

[link-packagist]: https://packagist.org/packages/triadev/laravel-logger-provider
[link-downloads]: https://packagist.org/packages/triadev/laravel-logger-provider/stats
[link-travis]: https://travis-ci.org/triadev/LaravelLoggerProvider