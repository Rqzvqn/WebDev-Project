<?php
namespace repositories;

use PDO;
use PDOException;

class GameListRepository extends Repository
{
    private string $getByUIdQuery = "SELECT gameListId, userId, name, description FROM gamelists WHERE userId = :userId";
    private string $getUIdByGameListIdQuery = "SELECT userId FROM gamelists WHERE gamelistId = :gameListId";
    private string $insertQuery = "INSERT INTO gamelists (userId, name, description) VALUES (?, ?, ?)";
    private string $deleteByIdQuery = "DELETE FROM gamelist_item WHERE gameListId = :gameListId;
                                        DELETE FROM gamelists WHERE gameListId = :gameListId";
    private string $addItemQuery = "INSERT INTO gamelist_item (gameListId, itemId) VALUES (?, ?)";
    private string $removeItemQuery = "DELETE FROM gamelist_item WHERE itemId = :itemId AND gameListId = :gameListId";

    public function getListsByUserId($userId) {
        try {
            $stmt = $this->connection->prepare($this->getByUIdQuery);

            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, 'models\GameList');
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }

    public function getUserIdByGameListId($gamelistId) {
        try {
            $stmt = $this->connection->prepare($this->getUIdByGameListIdQuery);

            $stmt->bindParam(':gameListId', $gamelistId);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }

    public function insertGameList($gameList) {
        try {
            $stmt = $this->connection->prepare($this->insertQuery);
            $stmt->execute([$_SESSION['userId'], $gameList->getName(), $gameList->getDescription()]);
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }

    public function deleteById($gameListId) {
        try {
            $stmt = $this->connection->prepare($this->deleteByIdQuery);
            $stmt->bindParam(':gameListId', $gameListId);
            $stmt->execute();
        } catch (PDOException $pdeo) {
            echo $pdeo;
        }
    }

    public function addToList($itemId, $gameListId) {
        try {
            $stmt = $this->connection->prepare($this->addItemQuery);

            $stmt->execute([$gameListId, $itemId]);
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }

    public function removeFromList($itemId, $gameListId) {
        try {
            $stmt = $this->connection->prepare($this->removeItemQuery);

            $stmt->bindParam(':itemId', $itemId);
            $stmt->bindParam(':gameListId', $gameListId);
            $stmt->execute();
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }
}