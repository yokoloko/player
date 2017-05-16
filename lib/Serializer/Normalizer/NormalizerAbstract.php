<?php

namespace Framework\Serializer\Normalizer;

use Framework\Serializer\Serializer;

abstract class NormalizerAbstract
{
    /**
     * @var $serializer Serializer
     */
    protected $serializer;

    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    abstract public function normalize($object);
    abstract public function supportsNormalization($data);
}