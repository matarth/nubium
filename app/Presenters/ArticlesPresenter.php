<?php

namespace App\Presenters;

use App\Repository\ArticleRepository;
use Nette\Utils\Paginator;

class ArticlesPresenter extends BasePresenter
{

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->articleRepository = $articleRepository;
    }

    public function renderDefault(int $page = 1): void
    {
        $paginator = new Paginator();
        $paginator->setItemCount($this->articleRepository->getArticlesCount());
        $paginator->setItemsPerPage(self::itemsPerPage);
        $paginator->setPage($page);

        $articles = $this->articleRepository->getArticlesForPage($paginator);
        $this->getTemplate()->articles = $articles;
        $this->getTemplate()->paginator = $paginator;
    }
}