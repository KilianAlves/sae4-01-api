<?php

namespace App\Factory;

use App\Entity\Vaccin;
use App\Repository\VaccinRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Vaccin>
 *
 * @method        Vaccin|Proxy                     create(array|callable $attributes = [])
 * @method static Vaccin|Proxy                     createOne(array $attributes = [])
 * @method static Vaccin|Proxy                     find(object|array|mixed $criteria)
 * @method static Vaccin|Proxy                     findOrCreate(array $attributes)
 * @method static Vaccin|Proxy                     first(string $sortedField = 'id')
 * @method static Vaccin|Proxy                     last(string $sortedField = 'id')
 * @method static Vaccin|Proxy                     random(array $attributes = [])
 * @method static Vaccin|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VaccinRepository|RepositoryProxy repository()
 * @method static Vaccin[]|Proxy[]                 all()
 * @method static Vaccin[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Vaccin[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Vaccin[]|Proxy[]                 findBy(array $attributes)
 * @method static Vaccin[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Vaccin[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VaccinFactory extends ModelFactory
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
            'dateRappel' => self::faker()->dateTime(),
            'libelle' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Vaccin $vaccin): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Vaccin::class;
    }
}
