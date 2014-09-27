pipedrive-php-api
=================

PHP API for Pipedrive

## Installation
Add the package as a dependency in your `composer.json` file:

``` javascript
require {
    "pinvoice/pipedrive-php-api": "dev-master"
}
```
Include the composer autoloader in your script. Set your Pipedrive API token and create an instance of the API. 

``` php
require 'vendor/autoload.php';
\Pinvoice\Pipedrive\API::setToken('TOKEN');
$pipedrive = \Pinvoice\Pipedrive\API::getInstance();
```

## Development

Run `composer install` in this directory. 

### Running tests
To start PHPUnit tests run: 
`vendor/bin/phpunit test`

To run tests at each commit, add Git hook:  
```
cp hooks/pre-commit .git/hooks
chmod 777 .git/hooks/pre-commit
```
