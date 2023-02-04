<?php

namespace App\Presenters\Api;

use App\Exception\DuplicateEntryException;
use App\Exception\UnauthorizedException;
use App\Services\Factory\VoteFactory;
use App\Services\Repository\VoteRepository;
use Codeception\Util\HttpCode;
use Nette\Application\BadRequestException;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Utils\JsonException;

class VotePresenter extends Presenter
{

    private VoteRepository $voteRepository;
    private VoteFactory $voteFactory;

    public function __construct(VoteRepository $voteRepository, VoteFactory $voteFactory){

        $this->voteRepository = $voteRepository;
        $this->voteFactory = $voteFactory;
    }

    public function startup()
    {
        parent::startup();
        if(!$this->user->isLoggedIn()){
            throw new UnauthorizedException("Unauthorized");
        }
    }

    public function actionDefault(){

        $request = $this->getRequest();
        if(!$request->isMethod('POST')){
            throw new BadRequestException(HttpCode::METHOD_NOT_ALLOWED);
        }

        $vote = intval($request->getPost('score'));
        $articleUuid = $request->getPost('articleUuid');

        if(!in_array($vote, [-1,1]) || is_null($articleUuid)){
            throw new BadRequestException(HttpCode::BAD_REQUEST);
        }

        $vote = $this->voteFactory->createFromApiRequest($request, $this->user);

        try{
            $this->voteRepository->createNewVote($vote);
        } catch (UniqueConstraintViolationException $e){
            $this->voteRepository->updateVote($vote);
        }

        $newScore = $this->voteRepository->getVotesForArticle($vote->getArticleId());
        $this->sendResponse(new JsonResponse(['status' => 'ok', 'articleScore' => $newScore]));

    }
}