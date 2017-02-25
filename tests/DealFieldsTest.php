<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class DealFieldsTest extends PHPUnit_Framework_TestCase
{

    private $pipedrive;
    private $dealfields;
    private $lastDealField;

    /**
     * Set up and test Pipedrive API connection, and add some test data.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->dealfields = $this->pipedrive->dealfields->getDealFields();

        // Last one is most likely to be custom
        $this->lastDealField = end($this->dealfields);

        if (!$this->pipedrive->dealfields->isCustomDealField($this->lastDealField->key)) {
            $this->markTestSkipped('No custom DealFields available.');
        }
    }

    /**
     * Try to get all DealFields. Pass if no exception thrown by APIObject's safeReturn().
     */
    public function testCanGetDealFields()
    {
        $this->pipedrive->dealfields->getDealFields();
    }

    /**
     * Get information about Deal Field by key.
     * Compare name to string ("Test") to verify.
     */
    public function testCanGetDealFieldByKey()
    {
        $dealfield = $this->pipedrive->dealfields->getDealFieldByKey(
            $this->lastDealField->key,
            $this->dealfields
        );

        $this->assertEquals($dealfield->key, $this->lastDealField->key);
    }

    /**
     * Try to translate DealFields key to it's value in a Deal.
     */
    public function testCanTranslateDealFieldKeys()
    {
        $deals = $this->pipedrive->deals->getDeals();
        $deal = end($deals);

        $this->assertTrue(property_exists($deal, $this->lastDealField->key));

        // Translate keys
        $this->pipedrive->dealfields->translateDealFieldKeys($deal, $this->dealfields);

        // Should be unset
        $this->assertFalse(property_exists($deal, $this->lastDealField->key));
    }

    public function testGetDealFieldByKeyEmptyIsNull () {
        $dealfields = $this->pipedrive->dealfields->getDealFieldByKey($this->lastDealField->key, array());

        $this->assertNull($dealfields);
    }

}