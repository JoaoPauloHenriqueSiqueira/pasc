<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use Carbon\Carbon;
use App\Services\DebtService;


class ClientService
{
    protected $repository;
    protected $debtConfigsService;
    protected $debtService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ClientRepositoryInterface $repository,
        DebtConfigsService $debtConfigsService,
        DebtService $debtService
    ) {
        $this->repository = $repository;
        $this->debtConfigsService = $debtConfigsService;
        $this->debtService = $debtService;
    }


    public function get()
    {
        return $this->repository->all();
    }

    public function find($request)
    {
        $client = $this->repository->find(array_get($request, "id"));

        if ($client) {
            return $this->debtService->calculateDebtsBy($client->get()->first());
        }

        return [];
    }

    public function findCpf($agent)
    {
        $parameters = $agent->getParameters();
        $client = $this->repository->findByCPF(array_get($parameters, "cpf"));

        if ($client) {
            return $this->debtService->echoDebts($client->get()->first());
        }

        return [];
    }
}
