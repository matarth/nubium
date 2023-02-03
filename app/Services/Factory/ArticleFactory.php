<?php

namespace App\Services\Factory;

use App\Entity\Article;
use Nette\Database\Table\ActiveRow;

class ArticleFactory
{

    public function createFromDbRow(ActiveRow $article): Article
    {

        return new Article(
            $article->id,
            $article->uuid,
            $article->perex,
            $article->text,
            $article->validSince,
            $article->created
        );
    }
}