<?php

namespace Framework\Request;

class Request
{
    private $get;
    private $post;
    private $server;

    public function __construct($get, $post, $server)
    {
        $this->post = $post;
        $this->get  = $get;
        $this->server = $server;
    }

    public function getAcceptedContentTypes()
    {
        if (is_array($this->server) && isset($this->server['HTTP_ACCEPT'])) {
            return explode(',', $this->server['HTTP_ACCEPT']);
        }

        return 'text/html';
    }

    public function getRequestUri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function getRequestMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPost()
    {
        return $this->post;
    }
}