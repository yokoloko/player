<?php

namespace Framework\Serializer\Encoder;

class XmlEncoder implements EncoderInterface
{
    public function encode($data)
    {
        $element = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->arrayToXml($data, $element);

        return $element->asXML();
    }

    public function arrayToXml($data, \SimpleXMLElement &$element)
    {
        foreach($data as $key => $value) {
            if (is_object($value)) {
                $value = (array)$value;
            }
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $element->addChild("$key");
                    $this->arrayToXml($value, $subnode);
                } else {
                    $subnode = $element->addChild("item$key");
                    $this->arrayToXml($value, $subnode);
                }
            } else {
                $element->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}