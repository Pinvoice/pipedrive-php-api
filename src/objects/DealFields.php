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
     * @param object $dealfields DealFields to look through (output of getDealFields()).
     * @return string DealField text that belongs to key.
     */
    public static function getDealFieldByKey($key, $dealfields)
    {
        foreach ($dealfields as $dealfield) {
            if ($dealfield->key == $key) {
                return $dealfield;
            }
        }

        return null;
    }

    /**
     * Translate all custom Deal fields in Deal.
     *
     * Get DealFields from getDealFields() (or somewhere else).
     * Iterate Deal keys.
     * Check if a Deal key is a custom DealField.
     * Translate DealField key to text, and copy ($foo->3d76a21... to $foo->name).
     * Unset old one ($foo->3d76a21...).
     *
     * @param Deal $deal Deal object with key as custom Deal fields.
     * @return Deal Deal object with text as custom Deal fields.
     */
    public static function translateDealFieldKeys($deal)
    {
        $dealfields = self::getDealFields();

        foreach ($deal as $key => $value) {
            if (DealFields::isCustomDealField($key)) {
                $name = DealFields::getDealFieldByKey($key, $dealfields)->name;
                $deal->$name = $deal->$key;
                unset($deal->$key);
            }
        }

        return $deal;
    }

    /**
     * Checks if Deal key is a custom Deal field.
     *
     * Checks for: 40 characters, loweralpha + numeric.
     *
     * @param string $key Key of Deal field.
     * @return boolean True if $key is custom Deal field.
     */
    private static function isCustomDealField($key)
    {
        return preg_match('/^[a-f0-9]{40}$/', $key);
    }

}
