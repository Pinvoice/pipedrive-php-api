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
[DealFields](https://developers.pipedrive.com/v1#methods-DealFields)       | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/DealFields.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#dealfields)
[Email](https://developers.pipedrive.com/v1#methods-EmailMessages)         | [X](#) | [X](#)
[Files](https://developers.pipedrive.com/v1#methods-Files)                 | [X](#) | [X](#)
[Notes](https://developers.pipedrive.com/v1#methods-Notes)                 | [X](#) | [X](#)
[Organizations](https://developers.pipedrive.com/v1#methods-Organizations) | [X](#) | [X](#)
[Persons](https://developers.pipedrive.com/v1#methods-Persons)             | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Persons.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#persons)
[PersonFields](https://developers.pipedrive.com/v1#methods-PersonFields)   | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/PersonFields.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#personfields)
[Pipelines](https://developers.pipedrive.com/v1#methods-Pipelines)         | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Pipelines.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#pipelines)
[Products](https://developers.pipedrive.com/v1#methods-Products)           | [X](#) | [X](#)
[Stages](https://developers.pipedrive.com/v1#methods-Stages)               | [P](https://github.com/Pinvoice/pipedrive-php-api/blob/master/src/objects/Stages.php) | [√](https://github.com/Pinvoice/pipedrive-php-api#stages)

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

$pipedrive = new PipedriveAPI('TOKEN');
```

## Usage

### Deals
```php
// Get all deals
$pipedrive->deals->getDeals();

// Get all deals, with optional filters
$pipedrive->deals->getDeals(array(
  'filter_id' => 12,
  'start' => 3,
  'limit' => 1,
  'sort_by' => 'first_name',
  'sort_mode' => 'asc',
  'owned_by_you' => true
));

// Get deal by ID
$pipedrive->deals->getDeal(70);

// Find deals by name
$pipedrive->deals->getDealsByName(array(
	'term' => 'money'
));

// Find deals by name, with optional filters
$pipedrive->deals->getDealsByName(array(
	'term' => 'money',
	'person_id' => 1,
	'org_id' => 2
));
```

### DealFields
```php
// Get all deal fields
$dealfields = $pipedrive->dealfields->getDealFields();

// Get deal field object by key (from deal fields set)
$field = $pipedrive->dealfields->getDealFieldByKey('109204dc0283d5ced6c0438f8b7a220ecac9238d', $dealfields);

// Translate custom fields in Deal object(s), keys to text
// For example, this will replace $deal->109204dc0283d5ced6c0438f8b7a220ecac9238d with $deal->test 
$deals = $pipedrive->deals->getDeals();

foreach ($deals as $deal) {
    $pipedrive->dealfields->translateDealFieldKeys($deal);
}
```

### Persons
```php
// Get all persons
$pipedrive->persons->getPersons();

// Get all persons, with optional filters
$pipedrive->persons->getPersons(array(
  'filter_id' => 12,
  'start' => 3,
  'limit' => 1,
  'sort_by' => 'first_name',
  'sort_mode' => 'asc'
));

// Get person by ID
$pipedrive->persons->getPerson(70);

// Find person by name
$pipedrive->persons->getPersonsByName(array(
  'term' => 'Junior'
));

// Find persons by name, with optional filters
$pipedrive->persons->getPersonsByName(array(
  'term' => 'Junior',
  'person_id' => 1,
  'org_id' => 2,
  'start' => 1,
  'limit' => 1,
  'search_by_email' => false
));
```

### PersonFields
```php
// Get all person fields
$personfields = $pipedrive->personfields->getPersonFields();

// Get person field object by key (from person fields set)
$field = $pipedrive->personfields->getPersonFieldByKey('109204dc0283d5ced6c0438f8b7a220ecac9238d', $personfields);

// Translate custom fields in Person object(s), keys to text
// For example, this will replace $person->109204dc0283d5ced6c0438f8b7a220ecac9238d with $person->test 
$persons = $pipedrive->persons->getPersons();

foreach ($persons as $person) {
    $pipedrive->personfields->translatePersonFieldKeys($person);
}
```

### Pipelines
```php
// Get all pipelines
$pipedrive->pipelines->getPipelines();

// Get pipeline by ID
$pipedrive->pipelines->getPipeline(1);

// Add pipeline with name
$pipedrive->pipelines->addPipeline(array(
  'name' => 'My happy little pipeline'
));
```

### Stages
```php
// Get all stages
$pipedrive->stages->getStages();

// Get stage by ID
$pipedrive->stages->getStage(70);

// Returns stages for provided pipeline
$pipedrive->stages->getStagesByPipelineId(1);
```

## Testing
Put `TOKEN` in your environment. I recommend creating a `phpunit.xml` file with the following contents.
``` xml
<phpunit>
    <php>
        <env name="TOKEN" value="some_token"/>
    </php>
</phpunit>
```
Run tests with `phpunit tests`.
