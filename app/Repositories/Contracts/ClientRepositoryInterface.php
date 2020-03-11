<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function all();

    public function save($request);

    public function find($request);

    public function findByCPF($request);

}
