<?php

namespace Framework\Repository;

abstract class Repository
{
    /**
     * @var \Pdo
     */
    protected $pdo;

    public function __construct(\Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
}