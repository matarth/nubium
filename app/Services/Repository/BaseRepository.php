<?php

namespace App\Services\Repository;

use Nette\Database\Table\Selection;

abstract class BaseRepository
{

    protected Selection $db;

    public function __construct(Selection $db)
    {
        $this->db = $db;
    }

}