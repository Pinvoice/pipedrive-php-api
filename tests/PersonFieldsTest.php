<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class PersonFieldsTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;
    private $personfields;
    private $lastPersonField;

    /**
     * Set up and test Pipedrive API connection, and add some test data.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->personfields = $this->pipedrive->personfields->getPersonFields();

        // Last one is most likely to be custom
        $this->lastPersonField = end($this->personfields);

        if (!$this->pipedrive->personfields->isCustomPersonField($this->lastPersonField->key)) {
            $this->markTestSkipped('No custom PersonFields available.');
        }
    }

    /**
     * Try to get all PersonFields. Pass if no exception thrown by APIObject's safeReturn().
     */
    public function testCanGetPersonFields()
    {
        $this->pipedrive->personfields->getPersonFields();
    }

    /**
     * Get information about Person Field by key.
     * Compare name to string ("Test") to verify.
     */
    public function testCanGetPersonFieldByKey()
    {
        $personfield = $this->pipedrive->personfields->getPersonFieldByKey(
            $this->lastPersonField->key,
            $this->personfields
        );

        $this->assertEquals($personfield->key, $this->lastPersonField->key);
    }

    /**
     * Try to translate Person key to it's value in a Deal.
     */
    public function testCanTranslatePersonFieldKeys()
    {
        $persons = $this->pipedrive->persons->getPersons();
        $person = end($persons);

        $this->assertTrue(property_exists($person, $this->lastPersonField->key));

        // Translate keys
        $this->pipedrive->personfields->translatePersonFieldKeys($person, $this->personfields);

        // TODO: Check the actual translation.

        // Should be unset
        $this->assertFalse(property_exists($person, $this->lastPersonField->key));
    }

    public function testGetPersonFieldByKeyEmptyIsNull () {
        $personfields = $this->pipedrive->personfields->getPersonFieldByKey(
            $this->lastPersonField->key,
            []
        );

        $this->assertNull($personfields);
    }

}