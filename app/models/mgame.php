<?php
namespace models;

use JsonSerializable;

class Mgame extends Item implements JsonSerializable
{
    private int $mprice;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getMprice(): int
    {
        return $this->mprice;
    }

    /**
     * @param int $mprice
     */
    public function setMprice(int $mprice): void
    {
        $this->mprice = $mprice;
    }
}