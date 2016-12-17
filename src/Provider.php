<?php declare(strict_types = 1);

namespace Link0\Settl;

use JsonSerializable;

final class Provider implements JsonSerializable
{
    use JsonObjectTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $checksum_type;

    /**
     * @var string
     */
    private $checksum;

    /**
     * @param string $name
     * @param string $url
     * @param Checksum $checksum
     */
    public function __construct(string $name, string $url, Checksum $checksum)
    {
        $this->name = $name;
        $this->url = $url;
        $this->checksum_type = $checksum->type();
        $this->checksum = $checksum->hash();
    }

    public function name()
    {
        return $this->name;
    }

    public function url()
    {
        return $this->url;
    }
}
