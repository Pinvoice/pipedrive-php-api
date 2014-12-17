<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class PersonsTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;
    private $persons;

    /**
     * Set up and test Pipedrive API connection, and get all Deals.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->persons = $this->pipedrive->persons->getPersons();

        if (is_null($this->persons)) {
            $this->markTestSkipped('There are no Persons available to test with.');
        }
    }

    /**
     * Try to get all Persons.
     */
    public function testCanGetPersons()
    {
        $this->pipedrive->persons->getPersons();
    }

    /**
     * Try to get Persons with Params.
     */
    public function testCanGetPersonsWithParams()
    {
        $params = array(
            'limit' => '1',
            'start' => '1'
        );
        $this->pipedrive->persons->getPersons($params);
    }

    /**
     * Try to get Persons by name.
     */
    public function testCanGetPersonsByName()
    {
        $params = array(
            'term' => 'testing'
        );
        $this->pipedrive->persons->getPersonsByName($params);
    }

    /**
     * Try to get single Person.
     */
    public function testCanGetSinglePerson()
    {
        // Try to get the first Person and compare the add_time.
        $firstPersonInPersons = $this->persons[0];
        $dealByFirstPersonId = $this->pipedrive->persons->getPerson($firstPersonInPersons->id);

        $this->assertEquals($firstPersonInPersons->add_time, $dealByFirstPersonId->add_time);
    }

}
