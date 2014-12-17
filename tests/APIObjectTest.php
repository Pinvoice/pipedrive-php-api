<?php

use Pinvoice\Pipedrive\API as PipedriveAPI;

class ApiObjectTest extends PHPUnit_Framework_TestCase
{
    private $pipedrive;

    /**
     * Set up and test Pipedrive API connection.
     */
    public function setUp()
    {
        $this->pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));

        if (!$this->pipedrive->isAuthenticated()) {
            $this->markTestSkipped('Cannot authenticate with Pipedrive.');
        }
    }

    /**
     * Test ValidatorException for validateDigit().
     * @expectedException Pinvoice\Pipedrive\Exceptions\ValidatorException
     */
    public function testDigitValidator()
    {
        $this->pipedrive->stages->getStage("a");
    }

}
