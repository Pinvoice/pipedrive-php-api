<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class APITest extends PHPUnit_Framework_TestCase
{

    private $pipedrive;

    /**
     * Set up and test Pipedrive API connection, and add some test data.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }
    }

    /**
     * API can authenticate with Pipedrive (valid token).
     */
    public function testCanAuthenticate()
    {
        $pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));
        $this->assertTrue($pipedrive->isAuthenticated());
    }

    /**
     * Disallow unknown params.
     * @expectedException Pinvoice\Pipedrive\Exceptions\APIException
     */
    public function testDoesNotAcceptUnknownParams() {
        $params = array(
            'not_existing' => 'test'
        );

        $this->pipedrive->deals->getDealsByName($params);
    }

}
