<?php

namespace App\Entity;

use DateTime;

class Article implements EntityInterface
{

    private int $id;
    private string $uuid;
    private string $perex;
    private string $text;
    private DateTime $validSince;
    private DateTime $created;

    private int $score;

    public function __construct(
        int $id,
        string $uuid,
        string $perex,
        string $text,
        DateTime $validSince,
        DateTime $created,
    ) {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->perex = $perex;
        $this->text = $text;
        $this->validSince = $validSince;
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getPerex(): string
    {
        return $this->perex;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return DateTime
     */
    public function getValidSince(): DateTime
    {
        return $this->validSince;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'perex' => $this->getPerex(),
            'text' => $this->getText(),
            'validSince' => $this->getValidSince()->format('Y-m-d H:i:s'),
            'created' => $this->getCreated()->format('Y-m-d H:i:s'),
        ];
    }
}