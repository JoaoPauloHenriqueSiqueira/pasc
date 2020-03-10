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


    public function get()
    {
        $debt = $this->first();

        if (!$debt) {
            return json_decode($this->mock());
        }

        return $debt;
    }

    public function first()
    {
        $debtConfigs = $this->repository->all()->get();
        return $debtConfigs->first();
    }

    public function save($request)
    {
        $datas = $request->all();
        $data = $this->make($datas);
        $this->repository->save($data);
        return redirect('/admin');
    }

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
