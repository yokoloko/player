<?php

namespace Framework\Response;

use Framework\Serializer\Encoder\XmlEncoder;

class XmlResponse extends Response
{
    protected $contentType = 'application/xml';

    public function compile()
    {
        $encoder = new XmlEncoder();

        return $encoder->encode($this->body);
    }
}