<?php

namespace App\Presenters\Front;

use App\Presenters\Front\BasePresenter;
use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Repository\ArticleRepository;
use Nette\Application\Attributes\Persistent;
use Nette\Application\BadRequestException;
use Nette\Utils\Paginator;

class ArticlesPresenter extends BasePresenter
{

    #[Persistent]
    public string $order = 'validSince';

    #[Persistent]
    public string $direction = 'DESC';


    private ArticleRepository $articleRepository;

    public function __construct(
        LoginCheckFactory $loginCheckFactory,
        ArticleRepository $articleRepository)
    {
        parent::__construct($loginCheckFactory);
        $this->articleRepository = $articleRepository;
    }

    public function renderDefault(int $page = 1, string $order = 'validSince', string $direction = 'DESC'): void
    {
        if(!in_array($order, ['validSince', 'perex', 'score'])){
            throw new BadRequestException("Unknown order keyword", 404);
        }

        if(!in_array($direction, ['DESC', 'ASC'])){
            throw new BadRequestException("Unknown direction keyword", 404);
        }

        $this->direction = $direction;
        $this->order = $order;

        $paginator = new Paginator();
        $paginator->setItemCount($this->articleRepository->getArticlesCount());
        $paginator->setItemsPerPage(self::itemsPerPage);
        $paginator->setPage($page);

        $articles = $this->articleRepository->getArticlesForPage($paginator, $order, $direction);
        $this->getTemplate()->articles = $articles;
        $this->getTemplate()->paginator = $paginator;
        $this->getTemplate()->voteLink = $this->link("Api:Vote:default");
    }
}