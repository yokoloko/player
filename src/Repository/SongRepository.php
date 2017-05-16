<?php

namespace App\Repository;

use Framework\Repository\Repository;
use App\Entity\Song;

class SongRepository extends Repository
{
    /**
     * Find the specified song null if not found
     *
     * @param $id
     * @return Song|null
     */
    public function find($id)
    {
        $query = "SELECT id, name, duration FROM song WHERE id = :id";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();

        if ($statement->rowCount() === 0) {
            return null;
        }

        $data = $statement->fetch();

        $song = new Song();
        $song->setName($data['name'])
            ->setId($data['id'])
            ->setDuration($data['duration']);

        return $song;
    }
}