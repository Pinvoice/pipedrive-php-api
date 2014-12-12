<?php

require('vendor/autoload.php');

use Pinvoice\Pipedrive\API as PipedriveAPI;

class APITest extends PHPUnit_Framework_TestCase
{

    /**
     * API can authenticate with Pipedrive (valid token).
     */
    public function testCanAuthenticate()
    {
        $pipedrive = new PipedriveAPI(getenv('PIPEDRIVE_TOKEN'));
        $this->assertTrue($pipedrive->isAuthenticated());
    }
}
