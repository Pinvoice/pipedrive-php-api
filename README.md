pipedrive-php-api
=================

PHP API for Pipedrive. Work in progress!  

[![Latest Stable Version](https://poser.pugx.org/pinvoice/pipedrive-php-api/v/stable.svg)](https://packagist.org/packages/pinvoice/pipedrive-php-api) [![Total Downloads](https://poser.pugx.org/pinvoice/pipedrive-php-api/downloads.svg)](https://packagist.org/packages/pinvoice/pipedrive-php-api) [![Latest Unstable Version](https://poser.pugx.org/pinvoice/pipedrive-php-api/v/unstable.svg)](https://packagist.org/packages/pinvoice/pipedrive-php-api) [![License](https://poser.pugx.org/pinvoice/pipedrive-php-api/license.svg)](https://packagist.org/packages/pinvoice/pipedrive-php-api)

Status
------

API | Implementation | Documentation
--- | ------------- | -------------------
[Activities](https://developers.pipedrive.com/v1#methods-Activities)       | [X](#) | [X](#)
[Deals](https://developers.pipedrive.com/v1#methods-Deals)                 | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Deals.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#deals)
[DealFields](https://developers.pipedrive.com/v1#methods-DealFields)                 | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/DealFields.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#dealfields)
[Email](https://developers.pipedrive.com/v1#methods-EmailMessages)         | [X](#) | [X](#)
[Files](https://developers.pipedrive.com/v1#methods-Files)                 | [X](#) | [X](#)
[Notes](https://developers.pipedrive.com/v1#methods-Notes)                 | [X](#) | [X](#)
[Organizations](https://developers.pipedrive.com/v1#methods-Organizations) | [X](#) | [X](#)
[Persons](https://developers.pipedrive.com/v1#methods-Persons)             | [X](#) | [X](#)
[Pipelines](https://developers.pipedrive.com/v1#methods-Pipelines)         | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Pipelines.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#pipelines)
[Products](https://developers.pipedrive.com/v1#methods-Products)           | [X](#) | [X](#)
[Stages](https://developers.pipedrive.com/v1#methods-Stages)               | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Stages.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#stages)

√ = Complete  
P = Partial  
X = Nothing  

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

### DealFields
```php
// Get all deal fields
$dealfields = $pipedrive->getDealFields();

// Get deal field object by key (from DealFields set)
$field = $pipedrive->getDealFieldByKey('109204dc0283d5ced6c0438f8b7a220ecac9238d', $dealfields);
$field->name; // name of deal field

// Translate custom fields in Deal from key to text
// For example, this will replace: 
// $deal->109204dc0283d5ced6c0438f8b7a220ecac9238d with $deal->test 
$deals = $pipedrive->getDeals();

foreach ($deals as $deal) {
    $pipedrive->translateDealFieldKeys($deal);
}
```

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
