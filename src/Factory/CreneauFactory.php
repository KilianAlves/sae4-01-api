<?php

namespace App\Factory;

use App\Entity\Creneau;
use App\Repository\CreneauRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Creneau>
 *
 * @method        Creneau|Proxy                     create(array|callable $attributes = [])
 * @method static Creneau|Proxy                     createOne(array $attributes = [])
 * @method static Creneau|Proxy                     find(object|array|mixed $criteria)
 * @method static Creneau|Proxy                     findOrCreate(array $attributes)
 * @method static Creneau|Proxy                     first(string $sortedField = 'id')
 * @method static Creneau|Proxy                     last(string $sortedField = 'id')
 * @method static Creneau|Proxy                     random(array $attributes = [])
 * @method static Creneau|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CreneauRepository|RepositoryProxy repository()
 * @method static Creneau[]|Proxy[]                 all()
 * @method static Creneau[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Creneau[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Creneau[]|Proxy[]                 findBy(array $attributes)
 * @method static Creneau[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Creneau[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CreneauFactory extends ModelFactory
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
            'debut' => self::faker()->randomFloat(),
            'fin' => self::faker()->randomFloat(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Creneau $creneau): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Creneau::class;
    }
}
