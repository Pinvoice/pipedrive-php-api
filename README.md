pipedrive-php-api
=================

PHP API for Pipedrive

## Installation
Include the `pipedrive-php-api` package in `composer.json`.  
Include the composer autoloader in your script: `require 'vendor/autoload.php';`  
Set your Pipedrive API token: `\Pinvoice\Pipedrive\API::setToken('TOKEN');`  
Create an instance of the API: `$pipedrive = \Pinvoice\Pipedrive\API::getInstance();`  

## Development

Run `composer install` in this directory. 

### Running tests
To start PHPUnit tests run: 
`vendor/bin/phpunit tests`

To run tests at each commit, add Git hook:  
```
cp hooks/pre-commit .git/hooks
chmod 777 .git/hooks/pre-commit
```
