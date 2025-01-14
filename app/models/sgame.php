<?php
namespace models;

use JsonSerializable;

class Sgame extends Item implements JsonSerializable
{
    private int $sprice;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getSprice(): int
    {
        return $this->sprice;
    }

    /**
     * @param int $sprice
     */
    public function setSprice(int $sprice): void
    {
        $this->sprice = $sprice;
    }
}