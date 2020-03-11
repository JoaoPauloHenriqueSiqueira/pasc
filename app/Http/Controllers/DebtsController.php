<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;

class DebtsController extends Controller
{
    protected $clientService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ClientService $clientService
    ) {
        $this->clientService = $clientService;
    }

    /**
     * Salva uma dívida
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        return $this->debtService->save($request);
    }

    /**
     *Lista todas as dividas de um cliente
     *
     * @param Request $request
     * @return void
     */
    public function get(Request $request)
    {
        try {
            return $this->clientService->find($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     *Lista todas as dividas de um cliente
     *
     * @param Request $request
     * @return void
     */
    public function getByCpf(Request $request)
    {
        try {
            $agent = \Dialogflow\WebhookClient::fromData($request->json()->all());
            $agent->reply($this->clientService->findCpf($agent));
            return response()->json($agent->render());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
