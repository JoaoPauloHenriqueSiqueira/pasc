<?php

namespace App\Services;

use App\Library\Format;
use App\Repositories\Contracts\ClientRepositoryInterface;
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

    /**
     * Get repository
     */
    public function get()
    {
        return $this->repository->all();
    }

    /**
     * Find
     *
     * @param [type] $request
     * @return void
     */
    public function find($request)
    {
        $client = $this->repository->find(array_get($request, "id"));

        if ($client) {
            return $this->debtService->calculateDebtsBy($client->get()->first());
        }

        return [];
    }

    /**
     * Find By CPF
     *
     * @param [type] $request
     * @return void
     */
    public function findCpf($request)
    {
        $agent = \Dialogflow\WebhookClient::fromData($request->json()->all());

        $parameters = $agent->getParameters();

        $cpf = Format::array_get($parameters, "cpf"));
        $client = $this->repository->findByCPF($cpf);

        if ($client) {
            $agent->reply($this->debtService->echoDebts($client->get()->first()));
            return $agent->render();
        }

        return [];
    }
}
