<?php

namespace App\Controller;

use App\Repository\SongRepository;

class SongController extends Controller
{
    public function showAction($id)
    {
        $repository = new SongRepository($this->pdo);
        $song = $repository->find($id);

        if ($song === null) {
            return $this->createResponse(null, 404);
        }

        return $this->createResponse($this->getSerializer()->serialize($song));
    }
}