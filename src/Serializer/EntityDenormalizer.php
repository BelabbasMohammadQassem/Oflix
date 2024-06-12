<?php

namespace App\Serializer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class EntityDenormalizer implements DenormalizerInterface
{
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $repository = $this->em->getRepository($type);
        $object = $repository->find($data);

        return $object;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        if (! is_numeric($data)) return false;
        if (! str_starts_with($type, 'App\Entity' )) return false;

        return true;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            'object' => true,
        ];
    }
}