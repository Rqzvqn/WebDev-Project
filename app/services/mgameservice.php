<?php
namespace services;

use repositories\MgamesRepository;

class MgameService
{
    private MgamesRepository $mgames_repository;

    public function __construct()
    {
        $this->mgames_repository = new MgamesRepository();
    }

    public function getAll() {
        return $this->mgames_repository->getAll();
    }

    public function getMgamesByGameListId($gameListId) {
        return $this->mgames_repository->getByGameListId($gameListId);
    }
}