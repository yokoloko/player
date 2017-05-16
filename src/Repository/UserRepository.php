<?php

namespace App\Repository;

use Framework\Repository\Repository;
use App\Entity\User;

class UserRepository extends Repository
{
    public function find($id)
    {
        $query = "SELECT id, email, firstname, lastname FROM user WHERE id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();

        if ($statement->rowCount() === 0) {
            return null;
        }

        $data = $statement->fetch();

        $user = new User();
        $user->setEmail($data['email'])
            ->setId($data['id'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname']);

        return $user;
    }
}