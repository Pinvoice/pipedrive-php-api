<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Pinvoice\Pipedrive\HTTP;

class PersonFields extends APIObject
{
    /**
     * Translate all custom Person fields in Person.
     *
     * Get PersonFields from getPersonFields() (or somewhere else).
     * Iterate Person keys.
     * Check if a Person key is a custom PersonField.
     * Translate PersonField key to text, and copy ($foo->3d76a21... to $foo->name).
     * Unset old one ($foo->3d76a21...).
     *
     * @param Person $person Person object with key as custom Person fields.
     * @return Person Person object with text as custom Person fields.
     */
    public static function translatePersonFieldKeys($person)
    {
        $personfields = self::getPersonFields();

        foreach ($person as $key => $value) {
            if (PersonFields::isCustomPersonField($key)) {
                $name = PersonFields::getPersonFieldByKey($key, $personfields)->name;
                $person->$name = $person->$key;
                unset($person->$key);
            }
        }

        return $person;
    }

    /**
     * Get all person fields.
     *
     * HTTP GET /personFields
     *
     * @return array Array of all person field objects.
     */
    public static function getPersonFields()
    {
        $data = HTTP::get('/personFields');
        return self::safeReturn($data);
    }

    /**
     * Checks if Person key is a custom Person field.
     *
     * Checks for: 40 characters, loweralpha + numeric.
     *
     * @param string $key Key of Person field.
     * @return boolean True if $key is custom Person field.
     */
    private static function isCustomPersonField($key)
    {
        return preg_match('/^[a-f0-9]{40}$/', $key);
    }

    /**
     * Translate PersonField key to text.
     *
     * @param string $key Key of Person field.
     * @param object $personfields PersonFields to look through (output of getPersonFields()).
     * @return string PersonField text that belongs to key.
     */
    public static function getPersonFieldByKey($key, $personfields)
    {
        foreach ($personfields as $personfield) {
            if ($personfield->key == $key) {
                return $personfield;
            }
        }

        return null;
    }

}
