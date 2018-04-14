Laravel API Client
=================

Laravel Snaptier is a [Snaptier API Client](https://github.com/snaptier/php-snaptier-client) bridge for [Laravel 5](http://laravel.com). It utilises GrahamCampbell's [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package.

<p align="center">
<a href="https://travis-ci.org/snaptier/laravel-api-client"><img src="https://img.shields.io/travis/snaptier/laravel-api-client/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/snaptier/laravel-api-client/releases"><img src="https://img.shields.io/github/release/snaptier/laravel-api-client.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

This package requires [PHP](https://php.net) 7.1 or 7.2 and supports Laravel 5.5 or 5.6 only.

To get the latest version, simply require the project using [Composer](https://getcomposer.org). You will need to install any package that "provides" `php-http/client-implementation`. Most users will want:

```bash
$ composer require snaptier/laravel-client php-http/guzzle6-adapter
```

Once installed, if you are not using automatic package discovery, then you need to register the `Snaptier\Laravel\SnaptierServiceProvider` service provider in your `config/app.php`.

You can also optionally alias our facade:

```php
        'Snaptier' => Snaptier\Laravel\Facades\Snaptier::class,
```


## Configuration

Laravel Snaptier requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/snaptier.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### Snaptier Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like. Note that the 3 supported authentication methods are: `"none"`, `"oauth"` and `"password"`.


## Usage

##### SnaptierManager

This is the class of most interest. It is bound to the ioc container as `'snaptier'` and can be accessed using the `Facades\Snaptier` facade. This class implements the `ManagerInterface` by extending `AbstractManager`. The interface and abstract class are both part of GrahamCampbell's [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `\Snaptier\API\Client`.

##### Facades\Snaptier

This facade will dynamically pass static method calls to the `'snaptier'` object in the ioc container which by default is the `SnaptierManager` class.

##### SnaptierServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
use Snaptier\Laravel\Facades\Snaptier;
// you can alias this in config/app.php if you like

Snaptier::api('users')->me();
// we're done here - how easy was that, it just works!
```

The snaptier manager will behave like it is a `\Snaptier\API\Client` class. If you want to call specific connections, you can do with the `connection` method:

```php
use Snaptier\Laravel\Facades\Snaptier;

// writing this:
Snaptier::connection('main')->api('users')->me();

// is identical to writing this:
Snaptier::api('users')->me();

// and is also identical to writing this:
Snaptier::connection()->api('users')->me();

// this is because the main connection is configured to be the default
Snaptier::getDefaultConnection(); // this will return main

// we can change the default connection
Snaptier::setDefaultConnection('alternative'); // the default is now alternative
```

If you prefer to use dependency injection over facades, then you can easily inject the manager like so:

```php
use Snaptier\Laravel\SnaptierManager;
use Illuminate\Support\Facades\App; // you probably have this aliased already

class Foo
{
    protected $snaptier;

    public function __construct(SnaptierManager $snaptier)
    {
        $this->snaptier = $snaptier;
    }

    public function bar()
    {
        $this->snaptier->api('users')->me();
    }
}

App::make('Foo')->bar();
```

For more information on how to use the `\Snaptier\API\Client` class we are calling behind the scenes here, check out the docs at https://github.com/snaptier/php-snaptier-client, and the manager class at https://github.com/GrahamCampbell/Laravel-Manager#usage.

##### Further Information

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.


## Security

If you discover a security vulnerability within this package, please send an e-mail to Miguel Piedrafita at soy@miguelpiedrafita.com. All security vulnerabilities will be promptly addressed.


## License

Laravel Snaptier is licensed under [The MIT License (MIT)](LICENSE).
