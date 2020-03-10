<?php

namespace App\Repositories\Contracts;

interface DebtConfigsRepositoryInterface
{
    public function all();

    public function save($data);
}
