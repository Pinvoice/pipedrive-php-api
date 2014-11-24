<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Zend\Validator\Digits;

abstract class APIObject
{

    /**
     * [$http description]
     * @var [type]
     */
    protected $http;

    /**
     * [__construct description]
     * @param [type] $http [description]
     */
    protected function __construct($http)
    {
        $this->http = $http;
    }

    /**
     * Handles errors in Pipedrive API requests.
     *
     * @param array $data JSON object.
     *
     * @throws \Exception if $data->success isn't there.
     * @return mixed Return data.
     */
    protected static function safeReturn($data)
    {
        if (!$data->success) {
            throw new \Exception(isset($data->error) ? "Pipedrive: " . $data->error : "Unknown error.");
        } else {
            return $data->data;
        }
    }

    /**
     * Validates if input is a number.
     *
     * @param $input mixed Input for validator.
     * @return bool Returns true if validation passed.
     * @throws \Exception if $input is not a number.
     */
    protected function validateDigit($input)
    {
        $validator = new Digits();
        if (!$validator->isValid($input)) {
            throw new \Exception("Validation failed: {$input} is not a digit in function " .
                debug_backtrace()[1]['function'] . ".");
        }
        return true;
    }

}
