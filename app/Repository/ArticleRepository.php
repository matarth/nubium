<?php

namespace App\Repository;

use App\Entity\Article;
use App\Factory\ArticleFactory;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Utils\Paginator;

class ArticleRepository extends BaseRepository
{

    private ArticleFactory $articleFactory;

    public function __construct(Explorer $db, ArticleFactory $articleFactory)
    {
        parent::__construct($db);
        $this->articleFactory = $articleFactory;
    }

    /**
     * @return Article[]
     */
    public function getAllArticles(): array
    {
        $ret = [];
        $articles = $this->db
            ->table('article')
            ->order('validSince DESC')
            ->fetchAll();

        foreach($articles as $article){
            $ret[] = $this->articleFactory->createFromDbRow($article);
        }

        return $ret;
    }

    /**
     * @return Article[]
     */
    public function getArticlesForPage(Paginator $paginator): array
    {
        $ret = [];
        $articles = $this->db->table('article')
            ->page(max(0, $paginator->getPage()), $paginator->getItemsPerPage())
            ->order('validSince DESC')
            ->fetchAll();

        foreach($articles as $article){
            $ret[] = $this->articleFactory->createFromDbRow($article);
        }

        return $ret;
    }

    public function getArticlesCount(): int
    {
        return $this->db->table('article')->count();
    }
}