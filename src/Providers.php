<?php declare(strict_types = 1);

namespace Link0\Settl;

use ArrayAccess;
use Countable;
use JsonSerializable;

final class Providers implements Countable, ArrayAccess, JsonSerializable
{
    /**
     * @var Provider[]
     */
    private $providers;

    /**
     * @param Provider[] $providers
     */
    public function __construct($providers = [])
    {
        $this->guardUniqueProviders($providers);

        $this->providers = $providers;
    }

    /**
     * @return Providers
     */
    public static function empty()
    {
        return new self();
    }

    /**
     * @param Provider $providers
     * @return Providers
     */
    public function add(Provider $provider): Providers
    {
        $newProviders = $this->providers;
        $newProviders[] = $provider;
        return new Providers($newProviders);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->providers[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->providers[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->providers[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->providers[$offset]);
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
        return count($this->providers);
    }

    public function jsonSerialize()
    {
        return $this->providers;
    }

    /**
     * @param Provider[] $providers
     * @return void
     */
    private function guardUniqueProviders($providers)
    {
        $providerNames = [];
        foreach ($providers as $provider) {
            if (in_array($provider->name(), $providerNames)) {
                throw new \LogicException("Providers should be unique per version");
            }
            $providerNames[] = $provider->name();
        }
    }
}
