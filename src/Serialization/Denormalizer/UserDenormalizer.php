<?php

declare(strict_types=1);

namespace App\Serialization\Denormalizer;

use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class UserDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    private const ALREADY_CALLED = 'USER_DENORMALIZER_ALREADY_CALLED';

    private UserPasswordHasherInterface $passwordHasher;
    private Security $security;

    public function __construct(UserPasswordHasherInterface $passwordHasher, Security $security)
    {
        $this->passwordHasher = $passwordHasher;
        $this->security = $security;
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return !isset($context[self::ALREADY_CALLED]) && Utilisateur::class == $type;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        /* @var Utilisateur $user */
        $user = $this->security->getUser();

        $context[self::ALREADY_CALLED] = true;
        if (isset($data['password'])) {
            $data['password'] = $this->passwordHasher->hashPassword($user, $data['password']);
        }

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }
}
