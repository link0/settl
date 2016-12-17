<?php declare(strict_types = 1);

namespace Link0\Settl;

trait JsonObjectTrait
{
    /**
     * @return string
     */
    public function toJson()
    {
        return str_replace('\/', '/', json_encode($this, JSON_PRETTY_PRINT));
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     *
     * {@inheritDoc}
     */
    function jsonSerialize()
    {
        $jsonObject = new \stdClass();
        foreach(get_object_vars($this) as $key => $value) {
            $jsonObject->$key = $value;
        }
        return $jsonObject;
    }
}
