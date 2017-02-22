<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class APITest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PipedriveAPI
     */
    private $pipedrive;

    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }
    }

    public function testCanAuthenticate()
    {
        $pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));
        $this->assertTrue($pipedrive->isAuthenticated());
    }

    /**
     * @expectedException Pinvoice\Pipedrive\Exceptions\PipedriveException
     */
    public function testDoesNotAcceptUnknownParams() {
        $params = array('not_existing' => 'test');
        $this->pipedrive->deals->getDealsByName($params);
    }

}
