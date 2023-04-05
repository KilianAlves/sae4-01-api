<?php

namespace App\Factory;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Utilisateur>
 *
 * @method        Utilisateur|Proxy                     create(array|callable $attributes = [])
 * @method static Utilisateur|Proxy                     createOne(array $attributes = [])
 * @method static Utilisateur|Proxy                     find(object|array|mixed $criteria)
 * @method static Utilisateur|Proxy                     findOrCreate(array $attributes)
 * @method static Utilisateur|Proxy                     first(string $sortedField = 'id')
 * @method static Utilisateur|Proxy                     last(string $sortedField = 'id')
 * @method static Utilisateur|Proxy                     random(array $attributes = [])
 * @method static Utilisateur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UtilisateurRepository|RepositoryProxy repository()
 * @method static Utilisateur[]|Proxy[]                 all()
 * @method static Utilisateur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Utilisateur[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Utilisateur[]|Proxy[]                 findBy(array $attributes)
 * @method static Utilisateur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Utilisateur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
abstract class UtilisateurFactory extends ModelFactory
{
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct();
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */

    /* fonction pour ajouter des Utilisateurs généres avec faker dans la bd */
    protected function getDefaults(): array
    {
        return [
            'CP' => self::faker()->postcode(),
            'adresse' => self::faker()->text(50),
            'civilite' => 'francais',
            'complementAdresse' => self::faker()->text(50),
            'email' => self::faker()->email(),
            'nom' => self::faker()->lastName(),
            'password' => 'test',
            'prenom' => self::faker()->firstName(),
            'roles' => [],
            'tel' => self::faker()->phoneNumber(),
            'ville' => self::faker()->city(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (Utilisateur $user) {
                $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
            });
    }
}
