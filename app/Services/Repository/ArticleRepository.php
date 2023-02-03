<?php

namespace App\Services\Repository;

use App\Entity\Article;
use App\Services\Factory\ArticleFactory;
use Nette\Database\Explorer;
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

        return $this->returnVotedArticles($ret);
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

        return $this->returnVotedArticles($ret);
    }

    public function getArticlesCount(): int
    {
        return $this->db->table('article')->count('id');
    }

    /**
     * @param Article[] $articles
     * @return Article[]
     */
    private function returnVotedArticles(array $articles): array
    {
        $articleIds = array_map(function(Article $article){
           return $article->getId();
        }, $articles);

        $votes = $this->db
            ->table('vote')
            ->select('article_id, SUM(plus) score')
            ->where('article_id', $articleIds)
            ->group('article_id')
            ->fetchAssoc('article_id=score');

        foreach($articles as $article){
            $article->setScore($votes[$article->getId()] ?? 0);
        }

        return $articles;
    }
}