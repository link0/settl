<?php declare(strict_types = 1);

namespace Link0\Settl;

use PDO;

final class PdoBoxRepository implements BoxRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    /**
     * @param string $name
     * @return Box
     */
    public function getByName(string $name): Box
    {
        $select = "SELECT * FROM `Box` WHERE `name` = :name";

        $statement = $this->pdo->prepare($select);
        $statement->bindParam('name', $name);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $mapping = [];
        foreach ($results as $result) {
            if (!isset($mapping[$result['version']][$result['provider']])) {
                $mapping[$result['version']][$result['provider']] = $result;
            }
        }

        $versions = Versions::empty();
        foreach ($mapping as $versionString => $providerInfo) {
            $providers = Providers::empty();
            foreach ($providerInfo as $provider) {
                $providers = $providers->add(new Provider(
                    $provider['provider'],
                    $provider['url'],
                    new Checksum(
                        $provider['checksum_type'],
                        $provider['checksum']
                    )
                ));
            }
            $version = new Version($versionString, $providers);
            $versions = $versions->add($version);
        }

        return new Box('link0/' . $name, 'foo', new Versions($versions));
    }

    public function store(Box $box, Version $version)
    {
        // TODO: Implement store() method.
    }
}
