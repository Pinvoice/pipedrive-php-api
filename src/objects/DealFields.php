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

    /**
     * Translate DealField key to text.
     *
     * @param string $key Key of Deal field.
     * @return string DealField text that belongs to key.
     */
    public static function getDealFieldByKey($key)
    {
        $dealfields = self::getDealFields();

        foreach ($dealfields as $dealfield) {
            if ($dealfield->key == $key) {
                return $dealfield;
            }
        }

        return null;
    }

}
