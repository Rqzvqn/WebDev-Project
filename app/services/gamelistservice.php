<?php
namespace services;

use repositories\GameListRepository;

class GameListService
{
    private GameListRepository $gameList_repository;

    public function __construct()
    {
        $this->gameList_repository = new GameListRepository();
    }

    public function getListsByUserId($userId) {
        return $this->gameList_repository->getListsByUserId($userId);
    }

    public function getUserIdByGameListId($gameListId) {
        return $this->gameList_repository->getUserIdByGameListId($gameListId);
    }

    public function getAll() {
        return $this->gameList_repository->getAll();
    }

    public function insertGameList($gameList) {
        $this->gameList_repository->insertGameList($gameList);
    }

    public function deleteById($gameListId) {
        $this->gameList_repository->deleteById($gameListId);
    }

    public function addToList($itemId, $gameListId) {
        $this->gameList_repository->addToList($itemId, $gameListId);
    }

    public function removeFromList($itemId, $gameListId) {
        $this->gameList_repository->removeFromList($itemId, $gameListId);
    }
}