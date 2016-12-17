<?php declare(strict_types = 1);

namespace Link0\Settl;

use JsonSerializable;

final class Box implements JsonSerializable
{
    use JsonObjectTrait;

    private $name;
    private $description;

    /**
     * @var Versions
     */
    private $versions;

     function __construct(string $name, string $description, $versions = null)
    {
        if (!$versions instanceof Versions) {
            $versions = Versions::empty();
        }

        $this->name = $name;
        $this->description = $description;
        $this->versions = $versions;
    }
}
