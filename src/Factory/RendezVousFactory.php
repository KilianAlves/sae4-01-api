<?php

namespace App\Factory;

use App\Entity\rendez_vous;
use App\Factory\ClientFactory;
use App\Factory\VeterinaireFactory;
use App\Repository\RendezVousRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<rendez_vous>
 *
 * @method        rendez_vous|Proxy create(array|callable $attributes = [])
 * @method static rendez_vous|Proxy createOne(array $attributes = [])
 * @method static rendez_vous|Proxy find(object|array|mixed $criteria)
 * @method static rendez_vous|Proxy findOrCreate(array $attributes)
 * @method static rendez_vous|Proxy first(string $sortedField = 'id')
 * @method static rendez_vous|Proxy last(string $sortedField = 'id')
 * @method static rendez_vous|Proxy random(array $attributes = [])
 * @method static rendez_vous|Proxy randomOrCreate(array $attributes = [])
 * @method static RendezVousRepository|RepositoryProxy repository()
 * @method static rendez_vous[]|Proxy[] all()
 * @method static rendez_vous[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static rendez_vous[]|Proxy[] createSequence(array|callable $sequence)
 * @method static rendez_vous[]|Proxy[] findBy(array $attributes)
 * @method static rendez_vous[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static rendez_vous[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class RendezVousFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'client' => ClientFactory::new(),
            'commentaireVeto' => self::faker()->text(50),
            'dateRdv' => self::faker()->dateTime(),
            'estDomicile' => self::faker()->randomNumber(),
            'estUrgent' => self::faker()->randomNumber(),
            'horaire' => self::faker()->randomNumber(),
            'motif' => self::faker()->text(50),
            'veterinaire' => VeterinaireFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(rendezvous $rendezVous): void {})
            ;
    }

    protected static function getClass(): string
    {
        return rendez_vous::class;
    }
}
