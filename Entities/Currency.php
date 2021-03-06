<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:44 PM
 */

class Currency
{
    public const USD = 'usd';

    private int $id;
    private string $name;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}