<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class DealsTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PipedriveAPI
     */
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

    public function testCanGetDeals()
    {
        $deals = $this->pipedrive->deals->getDeals();
        $this->assertObjectHasAttribute('id', $deals[0]);
    }

    /**
     * Try to get Deals with Params.
     */
    public function testCanGetDealsWithParams()
    {
        $this->pipedrive->deals->getDeals(array(
            'limit' => '1',
            'start' => '1'
        ));
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
