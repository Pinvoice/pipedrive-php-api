<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Pinvoice\Pipedrive\HTTP;

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
        return self::safeReturn($data);
    }

}
