<?php

namespace App\Services\Factory;

use App\Entity\Article;
use Nette\Database\IRow;

class ArticleFactory
{

    public function createFromDbRow(IRow $article): Article
    {

        $articleEntity =  new Article(
            $article->id,
            $article->uuid,
            $article->perex,
            $article->text,
            $article->validSince,
            $article->created,
        );

        $articleEntity->setScore($article?->score ?? 0);

        return $articleEntity;
    }
}