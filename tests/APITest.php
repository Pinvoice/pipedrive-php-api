<?php

require_once ('Pipedrive/API.php');

class APITest extends PHPUnit_Framework_TestCase
{

    public function testSetAPIToken()
    {
        $string = 'testtoken';

		\Pipedrive\API::setToken($string);

		$token = \Pipedrive\API::getToken();

        $this->assertEquals($token, $string);
    }

}