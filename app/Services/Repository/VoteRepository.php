<?php

namespace App\Services\Repository;

use App\Entity\Vote;
use Nette\Database\Explorer;

class VoteRepository extends BaseRepository
{

    public function __construct(Explorer $db){
        parent::__construct($db->table('vote'));
    }

    public function createNewVote(Vote $vote): void{
        $voteArray = $vote->toArray();
        unset($voteArray['id']);
        $this->db->insert($voteArray);
    }

    public function updateVote(Vote $vote): void {
        $voteArray = $vote->toArray();
        unset($voteArray['id']);
        $this->db
            ->where('user_id', $vote->getUserId())
            ->where('article_id', $vote->getArticleId())
            ->update($voteArray);
    }

    public function getVotesForArticle(int $articleId): int
    {
        return $this->db->select('sum(score) score')->where('article_id', $articleId)->fetch()->score;
    }

}