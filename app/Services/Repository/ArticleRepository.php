<?php

namespace App\Services\Repository;

use App\Entity\Article;
use App\Services\Factory\ArticleFactory;
use Nette\Database\Explorer;
use Nette\Security\User;
use Nette\Utils\Paginator;

class ArticleRepository extends BaseRepository
{

    private ArticleFactory $articleFactory;

    public function __construct(Explorer $db, ArticleFactory $articleFactory, User $user)
    {
        parent::__construct($db->table('article'));

        if(!$user->isLoggedIn()){
            $this->db->where('public', true);
        }

        $this->articleFactory = $articleFactory;
    }

    public function getArticlesCount(): int
    {
        return $this->db->count('id');
    }

    public function getArticleByUuid(string $articleUuid): Article {
        return $this->articleFactory->createFromDbRow($this->db->where('uuid', $articleUuid)->fetch());
    }

    public function getArticlesForPage(Paginator $paginator, string $order = 'validSince', string $direction = 'DESC'): array {
        $ret = [];
        $articles = $this->db
            ->select('article.*, SUM(IFNULL(:vote.score, 0)) score')
            ->group('article.id')
            ->page(max(0, $paginator->getPage()), $paginator->getItemsPerPage())
            ->order("$order $direction");

        $articles = $articles->fetchAll();

        foreach($articles as $article){
            $ret[] = $this->articleFactory->createFromDbRow($article);
        }

        return $ret;
    }
}