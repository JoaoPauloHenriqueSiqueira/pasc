<?php

namespace App\Http\Controllers;

use App\Services\DebtConfigsService;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;

class DebtConfigsController extends Controller
{
    protected $debtService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        DebtConfigsService $debtService,
        ClientService $clientService
    ) {
        $this->debtService = $debtService;
        $this->clientService = $clientService;
        $this->middleware('auth');
    }

    /**
     * Captura todos os clients
     * e a configuração
     *
     * @return void
     */
    public function index()
    {
        try {
            $config = $this->debtService->get();
            $clients = $this->clientService->get();
            return view('home', ['clients' => $clients->get(), 'configs' => $config]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Salva informações debt_configs
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        try {
            return $this->debtService->save($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Pega todas as informações da primeira debt_configs
     *
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        try {
            return $this->debtService->find($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
