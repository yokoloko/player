<?php

namespace App\Entity;

class Favorite
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Song
     */
    private $song;

    /**
     * @var User
     */
    private $user;


    public function __construct(User $user, Song $song)
    {
        $this->song = $song;
        $this->user = $user;
    }

    /**
     * @return Song
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * @param Song $song
     * @return Favorite
     */
    public function setSong(Song $song)
    {
        $this->song = $song;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Favorite
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Favorite
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}