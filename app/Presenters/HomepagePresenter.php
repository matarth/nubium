<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Database\Explorer;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    private Explorer $db;

    public function __construct(Nette\Database\Explorer $db)
    {
        parent::__construct();

        $this->db = $db;
    }

    public function renderDefault(): void
    {
        dumpe(
            $this->db->table('user')->count()
        );
    }
}
