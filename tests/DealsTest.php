<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class DealsTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;
    private $deals;

    /**
     * Set up and test Pipedrive API connection, and get all Deals.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }

        $this->deals = $this->pipedrive->deals->getDeals();

        if (is_null($this->deals)) {
            $this->markTestSkipped('There are no Deals available to test with.');
        }
    }

    /**
     * Try to get all Deals.
     */
    public function testCanGetDeals()
    {
        $this->pipedrive->deals->getDeals();
    }

    /**
     * Try to get Deals with Params.
     */
    public function testCanGetDealsWithParams()
    {
        $params = array(
            'limit' => '1',
            'start' => '1'
        );
        $this->pipedrive->deals->getDeals($params);
    }

    /**
     * Try to get Deals by name.
     */
    public function testCanGetDealsByName()
    {
        $params = array(
            'term' => 'testing'
        );
        $this->pipedrive->deals->getDealsByName($params);
    }

    /**
     * Try to get single Deal.
     */
    public function testCanGetSingleDeal()
    {
        // Try to get the first Deal and compare the add_time.
        $firstDealInDeals = $this->deals[0];
        $dealByFirstDealId = $this->pipedrive->deals->getDeal($firstDealInDeals->id);

        $this->assertEquals($firstDealInDeals->add_time, $dealByFirstDealId->add_time);
    }

}
