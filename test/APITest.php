<?php

require_once ('src/API.php');

class APITest extends PHPUnit_Framework_TestCase {

	public function testSetAPIToken() {
		$string = 'testtoken';

		\Pinvoice\Pipedrive\API::setToken($string);

		$token = \Pinvoice\Pipedrive\API::getToken();

		$this->assertEquals($token, $string);
	}

}
