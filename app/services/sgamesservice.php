<?php
namespace services;

use repositories\SgamesRepository;

class SgamesService
{
    private SgamesRepository $sgames_repository;

    public function __construct()
    {
        $this->sgames_repository = new SgamesRepository();
    }

    public function getAll()
    {
        return $this->sgames_repository->getAll();
    }

    public function getSgamesByGameListId($gameListId) {
        return $this->sgames_repository->getByGameListId($gameListId);
    }
}