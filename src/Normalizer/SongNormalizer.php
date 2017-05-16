<?php

namespace App\Normalizer;


use App\Entity\Song;
use Framework\Serializer\Normalizer\NormalizerAbstract;

class SongNormalizer extends NormalizerAbstract
{
    public function normalize($song)
    {
        return [
            'id' => $song->getId(),
            'name' => $song->getName(),
            'duration' => $song->getDuration()
        ];
    }

    public function supportsNormalization($data)
    {
        return $data instanceof Song;
    }
}