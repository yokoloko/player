<?php

namespace App\Repository;

use App\Entity\Favorite;
use App\Entity\User;
use Framework\Repository\Exception\AlreadyExistsException;
use Framework\Repository\Repository;
use App\Entity\Song;

class FavoriteRepository extends Repository
{
    /**
     * Insert the specified Favorite
     *
     * @param Favorite $favorite
     * @return bool
     * @throws AlreadyExistsException
     */
    public function insert(Favorite $favorite)
    {
        $query = "INSERT INTO favorite (song_id, user_id) VALUES (:song_id, :user_id)";

        $statement = $this->pdo->prepare($query);

        $params = [
            'song_id' => $favorite->getSong()->getId(),
            'user_id' => $favorite->getUser()->getId(),
        ];

        try {
            $statement->execute($params);
        } catch (\Exception $e) {
            throw new AlreadyExistsException();
        }

        $id = $this->pdo->lastInsertId();

        $favorite->setId($id);

        return true;
    }

    /**
     * Delete the specified Favorite
     *
     * @param Favorite $favorite
     * @return boolean
     */
    public function delete(Favorite $favorite)
    {
        $query = "DELETE FROM favorite WHERE id = :id";

        $statement = $this->pdo->prepare($query);

        $params = ['id' => $favorite->getId()];

        $statement->execute($params);

        return true;
    }

    /**
     * @param $id
     * @return Favorite
     */
    public function find($id)
    {
        $favorite = $this->findByCriteria(['id' => $id]);
        if ($favorite === null) {
            return null;
        }

        return $favorite[0];
    }

    /**
     * @param array $criteria
     * @return Favorite[]
     */
    public function findByCriteria($criteria = [])
    {
        $query = "
            SELECT f.id, f.song_id, f.user_id, s.name
                 , s.duration, u.email, u.firstname
                 , u.lastname
              FROM favorite f
              JOIN song s on s.id = f.song_id
              JOIN user u on u.id = f.user_id
        ";

        $where = [];
        $params = [];
        foreach ($criteria as $key => $value) {
            if ($key === 'user') {
                $where[] = "u.id = :user_id";
                $params['user_id'] = $value;
            }

            if ($key === 'id') {
                $where[] = "f.id = :id";
                $params['id'] = $value;
            }
        }

        $query .= count($where) > 0 ? " WHERE " . implode("\n AND ", $where) : "";

        $statement = $this->pdo->prepare($query);
        $statement->execute($params);

        if ($statement->rowCount() === 0) {
            return null;
        }

        $favorites = [];
        while (($data = $statement->fetchObject()) !== false) {
            $song = new Song();
            $song->setId($data->song_id);
            $song->setName($data->name);
            $song->setDuration($data->duration);

            $user = new User();
            $user->setId($data->user_id);
            $user->setFirstname($data->firstname);
            $user->setLastname($data->lastname);
            $user->setEmail($data->email);

            $favorite = new Favorite($user, $song);
            $favorite->setId($data->id);

            $favorites[] = $favorite;
        }

        return $favorites;
    }
}