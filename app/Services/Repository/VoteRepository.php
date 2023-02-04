<?php

namespace App\Services\Repository;

use App\Entity\Vote;
use Nette\Database\Explorer;

class VoteRepository
{

    private Explorer $db;

    public function __construct(Explorer $db){

        $this->db = $db;
    }

    public function createNewVote(Vote $vote): void{
        $voteArray = $vote->toArray();
        unset($voteArray['id']);
        $this->db->table('vote')->insert($voteArray);
    }

    public function getVotesForArticle(int $articleId): int
    {
        return $this->db->table('vote')->select('sum(score) score')->where('article_id', $articleId)->fetch()->score;
    }

}