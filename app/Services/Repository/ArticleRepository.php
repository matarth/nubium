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
    public function getArticlesForPage(Paginator $paginator, string $order = 'validSince', string $direction = 'DESC'): array
    {
        $ret = [];
        $articles = $this->db->table('article, SUM(vote.score)')
            ->page(max(0, $paginator->getPage()), $paginator->getItemsPerPage())
            ->order("$order $direction")
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

    public function getArticleByUuid(string $articleUuid): Article {
        return $this->articleFactory->createFromDbRow($this->db->table('article')->where('uuid', $articleUuid)->fetch());
    }

    public function getVotedArticles(Paginator $paginator, string $order = 'validSince', string $direction = 'DESC'): array {
        $ret = [];
        $articles = $this->db->query(
            "
                    SELECT * from article a LEFT JOIN (SELECT article_id, SUM(score) score FROM vote GROUP BY article_id) sc
                    ON a.id = sc.article_id ORDER BY ? ? LIMIT ?,?
                ",
            $order,
            $direction,
            $paginator->getItemsPerPage() * $paginator->getPage()-1,
            $paginator->getItemsPerPage()
        )->fetchAll();

        foreach($articles as $article){
            $ret[] = $this->articleFactory->createFromDbRow($article);
        }

        return $ret;
    }


    public function getVotedArticles2(Paginator $paginator, string $order = 'validSince', string $direction = 'DESC'): array {
        $ret = [];
        $articles = $this->db->table('article')
            ->select('article.*, SUM(IFNULL(:vote.score, 0)) score')
            ->group('article.id')
            ->page(max(0, $paginator->getPage()), $paginator->getItemsPerPage())
            ->order("$order $direction")
            ->fetchAll();

        foreach($articles as $article){
            $ret[] = $this->articleFactory->createFromDbRow($article);
        }

        return $ret;
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
            ->select('article_id')
            ->where('article_id', $articleIds)
            ->group('article_id')
            ->fetchAssoc('article_id=score');

        foreach($articles as $article){
            $article->setScore($votes[$article->getId()] ?? 0);
        }

        return $articles;
    }
}