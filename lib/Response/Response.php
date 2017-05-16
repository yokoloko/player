<?php

namespace Framework\Response;

class Response
{
    protected $body;
    protected $code;
    protected $contentType;
    protected $version = '1.1';

    public function __construct($body, $code = 200)
    {
        $this->code = $code;
        $this->body = $body;
    }

    /**
     * @return $this
     */
    private function sendHeaders()
    {
        // headers have already been sent by the developer
        if (headers_sent()) {
            return $this;
        }

        header(sprintf('HTTP/%s %s %s', $this->version, $this->code, 'OK'), true, $this->code);
        header('Content-Type:' . $this->contentType, false, $this->code);

        return $this;
    }

    public function compile()
    {
        return $this->body;
    }

    public function send()
    {
        $this->sendHeaders();

        echo $this->compile();
    }
}