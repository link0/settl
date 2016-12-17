<?php declare(strict_types = 1);

namespace Link0\Settl;

final class Checksum
{
    const TYPE_MD5 = 'md5';
    const TYPE_SHA1 = 'sha1';
    const TYPE_SHA256 = 'sha256';
    const TYPE_SHA512 = 'sha512';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $hash;

    /**
     * @param string $type
     * @param string $hash
     */
    public function __construct(string $type, string $hash)
    {
        $this->guardAgainstInvalidHashLength($type, $hash);

        $this->type = $type;
        $this->hash = $hash;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function hash(): string
    {
        return $this->hash;
    }

    /**
     * This guard prevents invalid checksum lengths for a given type
     *
     * @param string $type
     * @param string $hash
     * @return void
     */
    private function guardAgainstInvalidHashLength($type, $hash)
    {
        $type = strtolower($type);
        $hashLength = strlen($hash);

        if (
            ($type === static::TYPE_MD5 && $hashLength != 32)
            || ($type === static::TYPE_SHA1 && $hashLength != 40)
            || ($type === static::TYPE_SHA256 && $hashLength != 64)
            || ($type === static::TYPE_SHA512 && $hashLength != 128)
        ) {
            throw new \LogicException("Invalid hash in checksum with length {$hashLength} for type {$type}");
        }
    }
}
