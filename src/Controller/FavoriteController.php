<?php

namespace App\Controller;

use App\Entity\Favorite;
use Framework\Repository\Exception\AlreadyExistsException;

class FavoriteController extends Controller
{
    public function listAction($search = [])
    {
        /** @var $favorites Favorite[] */
        $favorites = $this->getRepository('\App\Repository\FavoriteRepository')->findByCriteria($search);

        return $this->createResponse($this->getSerializer()->serialize($favorites));
    }

    public function addAction()
    {
        $post = $this->request->getPost();

        $userId = $post['user_id'];
        $songId = $post['song_id'];

        $user = $this->getRepository('\App\Repository\UserRepository')->find($userId);
        $song = $this->getRepository('\App\Repository\SongRepository')->find($songId);

        if ($user === null || $song === null) {
            return $this->createResponse(null, 404);
        }

        $favorite = new Favorite($user, $song);

        try {
            $this->getRepository('\App\Repository\FavoriteRepository')->insert($favorite);
        } catch (AlreadyExistsException $e) {
            return $this->createResponse(null, 409);
        }

        return $this->createResponse($this->getSerializer()->serialize($favorite));
    }

    public function deleteAction($id)
    {
        /** @var $favorites Favorite[] */
        $favorite = $this->getRepository('\App\Repository\FavoriteRepository')->find($id);

        if ($favorite === null) {
            return $this->createResponse([], 404);
        }

        $this->getRepository('\App\Repository\FavoriteRepository')->delete($favorite);

        return $this->createResponse(null);
    }
}