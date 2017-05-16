<?php

namespace Framework\Response;

class JsonResponse extends Response
{
    protected $contentType = 'application/json';

    public function compile()
    {
        return json_encode($this->body);
    }
}