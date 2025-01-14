<?php
namespace repositories;
use PDO;
use PDOException;

class SgamesRepository extends Repository
{
    private string $getAllQuery = "SELECT items.itemId, items.title, items.creator, sgames.sprice
                                    FROM items
                                    INNER JOIN sgames ON items.itemId = sgames.itemId
                                    ORDER BY items.title;";

    private string $getByGameListIdQuery = "SELECT items.itemId, items.title, items.creator, sgames.sprice
                                                FROM items
                                                INNER JOIN sgames ON items.itemId = sgames.itemId
                                                INNER JOIN gamelist_item ON items.itemId = gamelist_item.itemId
                                                WHERE gamelist_item.gameListId = :gameListId";

    public function getAll() {
        try {
            $stmt = $this->connection->prepare($this->getAllQuery);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'models\Sgame');
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }

    public function getByGameListId($gameListId) {
        try {
            $stmt = $this->connection->prepare($this->getByGameListIdQuery);

            $stmt->bindParam(':gameListId', $gameListId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, 'models\Sgame');
        } catch (PDOException $pdoe) {
            echo $pdoe;
        }
    }
}