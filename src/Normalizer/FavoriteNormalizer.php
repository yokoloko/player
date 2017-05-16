<?php

namespace App\Normalizer;

use App\Entity\Favorite;
use Framework\Serializer\Normalizer\NormalizerAbstract;

class FavoriteNormalizer extends NormalizerAbstract
{
    /**
     * @param $favorite Favorite
     * @return object
     */
    public function normalize($favorite)
    {
        return [
            'id'   => $favorite->getId(),
            'user' => $this->serializer->serialize($favorite->getUser()),
            'song' => $this->serializer->serialize($favorite->getSong())
        ];
    }

    public function supportsNormalization($data)
    {
        return $data instanceof Favorite;
    }
}