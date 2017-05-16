<?php

namespace Framework\Serializer;

use Framework\Serializer\Normalizer\NormalizerAbstract;

class Serializer
{
    /**
     * @var $normalizer NormalizerAbstract[]
     */
    private $normalizers;

    public function serialize($object)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsNormalization($object)) {
                return $normalizer->normalize($object);
            }
        }

        throw new \RuntimeException('Object not supported');
    }

    public function addNormalizer(NormalizerAbstract $normalizer)
    {
        $normalizer->setSerializer($this);
        $this->normalizers[] = $normalizer;
    }
}