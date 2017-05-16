<?php

namespace Framework\Controller;

use Framework\Repository\Repository;
use Framework\Request\Request;
use Framework\Serializer\Serializer;

abstract class Controller
{
    /**
     * @var \PDO
     */
    protected $pdo;
    /**
     * @var \PDO
     */
    protected $serializer;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param \PDO $pdo
     * @return $this
     */
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param $repository
     * @return Repository
     */
    public function getRepository($repository)
    {
        return new $repository($this->pdo);
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return new Serializer();
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }
}