<?php

namespace App\Normalizer;

use App\Entity\User;
use Framework\Serializer\Normalizer\NormalizerAbstract;

class UserNormalizer extends NormalizerAbstract
{
    public function normalize($user)
    {
        return [
            'id'    => $user->getId(),
            'name'  => $user->getFullname(),
            'email' => $user->getEmail()
        ];
    }

    public function supportsNormalization($data)
    {
        return $data instanceof User;
    }
}