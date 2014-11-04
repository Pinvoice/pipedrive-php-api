<?php

namespace Pinvoice\Pipedrive;

class DealFields extends APIObject
{
    /**
     * Get all deal fields.
     *
     * HTTP GET /dealFields
     *
     * @return array Array of all deal field objects.
     */
    public static function getDealFields()
    {
        $data = HTTP::get('/dealFields');
        return API::safe_return($data);
    }

}
