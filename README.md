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

use Pinvoice\Pipedrive\API as PipedriveAPI;

PipedriveAPI::setToken('TOKEN');
$pipedrive = PipedriveAPI::getInstance();
```

## Usage
### Pipelines
```php
// Get all pipelines
$pipedrive->getPipelines();

// Get pipeline by ID
$pipedrive->getPipeline(1);

// Add pipeline with name
$pipedrive->addPipeline(array(
  'name' => 'My happy little pipeline'
));
```

### Stages
```php
// Get all stages
$pipedrive->getStages();

// Get stage by ID
$pipedrive->getStage(70);

// Returns stages for provided pipeline
$pipedrive->getStagesByPipelineId(1);
```

### Deals
```php
// Get all deals
$pipedrive->getDeals();
$pipedrive->getDeals(array(
  'filter_id' => 12,
  'start' => 3,
  'limit' => 1,
  'sort_by' => "first_name",
  'sort_mode' => "asc",
  'owned_by_you' => true
));

// Get deal by ID
$pipedrive->getDeal(70);

// Find deals by name
$pipedrive->getDealsByName(array(
	'term' => "money"
));
$pipedrive->getDealsByName(array(
	'term' => "money",
	'person_id' => 1,
	'org_id' => 2
));

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
