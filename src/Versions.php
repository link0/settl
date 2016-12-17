<?php declare(strict_types = 1);

namespace Link0\Settl;

use Countable;
use JsonSerializable;

final class Versions implements Countable, JsonSerializable
{
    /**
     * @var Version[]
     */
    private $versions;

    /**
     * @param Version[] $versions
     */
    public function __construct($versions = [])
    {
        $this->versions = $versions;
    }

    /**
     * @return Versions
     */
    public static function empty(): Versions
    {
        return new self();
    }

    /**
     * @param Version $version
     * @return Versions
     */
    public function add(Version $version): Versions
    {
        $newVersions = $this->versions;
        $newVersions[] = $version;
        return new Versions($newVersions);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->versions);
    }

    public function jsonSerialize()
    {
        return $this->versions;
    }

}
