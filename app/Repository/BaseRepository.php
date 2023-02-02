<?php

namespace App\Repository;

use Nette\Database\Explorer;

abstract class BaseRepository
{

    protected Explorer $db;

    public function __construct(Explorer $db){

        $this->db = $db;
    }

}