<?php

namespace App\Presenters\Front;

use App\Presenters\Front\BasePresenter;
use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Repository\ArticleRepository;
use Nette\Utils\Paginator;

class ArticlesPresenter extends BasePresenter
{

    private ArticleRepository $articleRepository;

    public function __construct(
        LoginCheckFactory $loginCheckFactory,
        ArticleRepository $articleRepository)
    {
        parent::__construct($loginCheckFactory);
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
        $this->getTemplate()->voteLink = $this->link("Api:Vote:default");
    }
}