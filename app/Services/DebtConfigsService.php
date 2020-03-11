<?php

namespace App\Services;

use App\Repositories\Contracts\DebtConfigsRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DebtConfigsService
{
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DebtConfigsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get data
     *
     * @return void
     */
    public function get()
    {
        $debt = $this->first();

        if (!$debt) {
            return json_decode($this->mock());
        }

        return $debt;
    }

    /**
     * Return First register
     *
     * @return void
     */
    public function first()
    {
        $debtConfigs = $this->repository->all()->get();
        return $debtConfigs->first();
    }

    /**
     * Save data
     *
     * @param [type] $request
     * @return void
     */
    public function save($request)
    {
        $datas = $request->all();
        $data = $this->make($datas);
        $this->repository->save($data);
        return redirect('/admin');
    }

    /**
     * Normalize 
     *
     * @param [type] $data
     * @return void
     */
    private function make($data)
    {
        $tax = 1;
        if (array_get($data, "tipo")) {
            $tax = 2;
            unset($data['tipo']);
        }
        $data['tax_id'] = $tax;
        return $data;
    }

    /**
     * Mock data
     *
     * @return void
     */
    private function mock()
    {
        $data = [];
        $data['value_tax'] = "2";
        $data['quant_parcel'] = "3";
        $data['sale_commission'] = "10";
        $data['tax_id'] = "1";

        return json_encode($data);
    }
}
