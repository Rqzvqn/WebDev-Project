<?php

use models\GameList;
use services\MgameService;
use services\SgamesService;
use services\GameListService;

include 'autoload.php';

class MyListsController
{
    private GameListService $gameList_service;
    private SgamesService $sgames_service;
    private MgameService $mgame_service;

    public function __construct()
    {
        $this->gameList_service = new GameListService();
        $this->sgames_service = new SgamesService();
        $this->mgame_service = new MgameService();
    }

    public function index()
    {
        echo json_encode($this->gameList_service->getAll());  
    }

    public function getListsByUserId($userId)
    {
        echo json_encode($this->gameList_service->getListsByUserId($userId));
    }

    public function getUserId() {
        echo json_encode($_SESSION['userId']);
    }

    public function createGameList()
    {
        $json = file_get_contents('php://input');
        $object = json_decode($json);

        $gameList = new GameList();
        $gameList->setName($object->name);
        $gameList->setDescription($object->description);

        $this->gameList_service->insertGameList($gameList);
    }

    public function deleteGameList($gameListId)
    {
        $this->gameList_service->deleteById($gameListId);
    }

    public function getMgamesByGameListId($gameListId) {
        echo json_encode($this->mgame_service->getMgamesByGameListId($gameListId));
    }

    public function getSgamesByGameListId($gameListId) {
        echo json_encode($this->sgames_service->getSgamesByGameListId($gameListId));
    }

    public function addToList() {
        $json = file_get_contents('php://input');
        $object = json_decode($json);

        $itemId = $object->itemId;
        $gameListId = $object->gameListId;
        $this->gameList_service->addToList($itemId, $gameListId);
    }

    public function removeFromList() {
        $json = file_get_contents('php://input');
        $object = json_decode($json);

        $itemId = $object->itemId;
        $gameListId = $object->gameListId;
        $this->gameList_service->removeFromList($itemId, $gameListId);
    }
}