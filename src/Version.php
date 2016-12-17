<?php declare(strict_types = 1);

namespace Link0\Settl;

use JsonSerializable;

final class Version implements JsonSerializable
{
    use JsonObjectTrait;

    public function __construct(string $version, Providers $providers)
    {
        $this->guardUniqueProviders($providers);

        $this->version = $version;
        $this->providers = $providers;
    }

    private function guardUniqueProviders(Providers $providers)
    {
        $providerNames = [];
        foreach ($providers as $provider) {
            $providersNames[] = $provider->name();
        }
    }
}
