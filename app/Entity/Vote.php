<?php

namespace App\Entity;

class Vote implements EntityInterface
{

    private int $id;
    private int $userId;
    private int $articleId;

    public function __construct(int $id, int $userId, int $articleId){

        $this->id = $id;
        $this->userId = $userId;
        $this->articleId = $articleId;
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

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'article_id' => $this->getArticleId(),
            'user_id' => $this->getUserId()
        ];
    }
}