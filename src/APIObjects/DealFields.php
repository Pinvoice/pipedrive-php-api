<?php

namespace Pinvoice\Pipedrive\APIObjects;

class DealFields extends APIObject
{

    /**
     * [__construct description]
     * @param [type] $http [description]
     */
    public function __construct($http)
    {
        parent::__construct($http);
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
     * @param DealFields $dealfields Optional custom DealFields data.
     * @return Deal Deal object with text as custom Deal fields.
     */
    public function translateDealFieldKeys($deal, $dealfields = null)
    {
        $dealfields = $this->getDealFields();

        foreach ($deal as $key => $value) {
            if ($this->isCustomDealField($key)) {
                $name = $this->getDealFieldByKey($key, $dealfields)->name;
                $deal->$name = $deal->$key;
                unset($deal->$key);
            }
        }

        return $deal;
    }

    /**
     * Get all deal fields.
     *
     * HTTP GET /dealFields
     *
     * @return array Array of all deal field objects.
     */
    public function getDealFields()
    {
        $data = $this->http->get('/dealFields');
        return $this->safeReturn($data);
    }

    /**
     * Checks if Deal key is a custom Deal field.
     *
     * Checks for: 40 characters, loweralpha + numeric.
     *
     * @param string $key Key of Deal field.
     * @return boolean True if $key is custom Deal field.
     */
    private function isCustomDealField($key)
    {
        return preg_match('/^[a-f0-9]{40}$/', $key);
    }

    /**
     * Translate DealField key to text.
     *
     * @param string $key Key of Deal field.
     * @param object $dealfields DealFields to look through (output of getDealFields()).
     * @return string DealField text that belongs to key.
     */
    public function getDealFieldByKey($key, $dealfields)
    {
        foreach ($dealfields as $dealfield) {
            if ($dealfield->key == $key) {
                return $dealfield;
            }
        }

        return null;
    }

}
