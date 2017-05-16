<?php

namespace Framework\Serializer\Normalizer;

class ArrayNormalizer extends NormalizerAbstract
{
    public function normalize($iterable)
    {
        $data = [];
        foreach ($iterable as $key => $value) {
             $data[] = $this->serializer->serialize($value);
        }

        return $data;
    }

    public function supportsNormalization($data)
    {
        return is_iterable($data);
    }
}