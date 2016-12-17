<?php declare(strict_types = 1);

namespace Link0\Settl;

interface BoxRepository
{
    /**
     * @param string $name
     * @return Box
     */
    public function getByName(string $name): Box;
    public function store(Box $box, Version $version);
}
