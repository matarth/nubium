<?php

namespace App\Services\Factory;

use App\Entity\Vote;
use App\Services\Repository\ArticleRepository;
use Nette\Application\Request;
use Nette\Security\User;

class VoteFactory
{

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function createFromApiRequest(Request $request, User $user): Vote
    {
        $articleUuid = $request->getPost('articleUuid');
        $score = intval($request->getPost('score'));

        $article = $this->articleRepository->getArticleByUuid($articleUuid);

        /**
         * @var \App\Entity\User $userentity
         */
        // @phpstan-ignore-next-line
        $userEntity = $user->getIdentity()->getData()['entity'];

        return new Vote(
            0,
            $userEntity->getId(),
            $article->getId(),
            $score
        );
    }

}