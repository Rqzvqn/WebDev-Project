<?php
namespace models;

use JsonSerializable;

class GameList implements JsonSerializable
{
    private int $gameListId;
    private string $name;
    private string $description;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getGameListId(): int
    {
        return $this->gameListId;
    }

    /**
     * @param int $gameListId
     */
    public function setGameListId(int $gameListId): void
    {
        $this->gameListId = $gameListId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}