<?php

namespace App\Controller;

use App\Repository\UserRepository;

class UserController extends Controller
{
    public function showAction($id)
    {
        $repository = new UserRepository($this->pdo);
        $user = $repository->find($id);

        if ($user === null) {
            return $this->createResponse([], 404);
        }

        return $this->createResponse($this->getSerializer()->serialize($user));
    }
}