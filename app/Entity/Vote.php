<?php

namespace App\Entity;

class Vote implements EntityInterface
{

    private int $id;
    private int $userId;
    private int $articleId;
    private int $score;

    public function __construct(int $id, int $userId, int $articleId, int $score)
    {

        $this->id = $id;
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'article_id' => $this->getArticleId(),
            'user_id' => $this->getUserId(),
            'score' => $this->getScore()
        ];
    }
}