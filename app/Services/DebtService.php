<?php

namespace App\Services;

use App\Library\Format;
use Carbon\Carbon;

class DebtService
{
    protected $debtConfigsService;
    protected $config;
    protected $tax;
    protected $quantParcel;
    protected $saleCommission;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        DebtConfigsService $debtConfigsService
    ) {
        $this->debtConfigsService = $debtConfigsService;
        $this->config =  $this->debtConfigsService->get();
        $this->tax = array_get($this->config, "value_tax");
        $this->quantParcel = array_get($this->config, "quant_parcel");
        $this->saleCommission = array_get($this->config, "sale_commission");
    }


    /**
     * Realiza calculo dos juros por cliente
     *
     * @param [type] $client
     * @return void
     */
    public function calculateDebtsBy($client)
    {
        $debts = array_get($client, "debts", []);
        $total = 0;
        foreach ($debts as &$debt) {
            $debt = $this->transformDebt($debt);
            $total += (float) array_get($debt, "valueTotal");
        }
        $client['total'] = Format::formatCoin($total);
        return $client;
    }

    public function echoDebts($client)
    {
        $debts = $this->calculateDebtsBy($client);

        $nome = array_get($debts, "name");
        $total = array_get($debts, "total");

        if ($nome == "") {
            return "Seu registro não consta em nossa base 🤓";
        }

        if ($total == "R$0,00") {
            return "$nome, você não possui nenhuma dívida 😀";
        }

        return "$nome, você possui uma dívida de $total";
    }

    public function transformDebt($debt)
    {
        $dataCalculo = Carbon::now();
        $dateDebt = Carbon::parse(array_get($debt, "updated_at"));
        $diasAtraso =  $this->diffDaysPayment($dataCalculo, $dateDebt);
        $calculate = $this->calculate(array_get($debt, "value"), $diasAtraso);
        $parcelaString = $this->getParcels($dataCalculo, array_get($calculate, "totalParcels"));

        return $this->getFinalDebt($debt, $parcelaString, $calculate, $diasAtraso);
    }

    public function getFinalDebt($debt, $parcelaString, $calculate, $diasAtraso)
    {
        $valueTotal = array_get($calculate, "totalValue");

        $debt['parcels'] = $parcelaString;
        $debt['salesComis'] = Format::formatCoin(array_get($calculate, "valueComis"));
        $debt['valueTotal'] = $valueTotal;
        $debt['valueTotalFormat'] = Format::formatCoin($valueTotal);
        $debt['value'] = Format::formatCoin($debt['value']);
        $debt['daysLate'] = $diasAtraso;
        return $debt;
    }

    public function getParcels($dataCalculo, $parcelas)
    {
        $parcelaString = "";

        $i = 0;
        while ($i < $this->quantParcel) {
            ++$i;
            $datePayment = Carbon::parse($dataCalculo);
            $datePayment = $datePayment->addMonth($i)->format("d/m/Y");
            $parcelaString .= "<b>$i</b> - $parcelas -  Data vencimento: $datePayment<br>";
        }

        return $parcelaString;
    }


    public function diffDaysPayment($dataCalculo, $dateDebt)
    {
        return $dataCalculo->diffInDays($dateDebt);
    }

    public function calculate($originalValue, $diasAtraso)
    {
        $tax = array_get($this->config, "tax_id");
        switch ($tax) {
            case 1:
                return $this->calculateSimpleTax($originalValue, $diasAtraso);
                break;
            case 2:
                return $this->calculateCompTax($originalValue, $diasAtraso);
                break;
            default:
                return $originalValue;
        }
    }

    public function calculateSimpleTax($originalValue, $diasAtraso)
    {
        $tax =  ($this->tax / 100) * $diasAtraso;

        $taxValue = $originalValue * $tax;
        $sumValueTax = $originalValue + $taxValue;
        $valueComis = ($sumValueTax * $this->saleCommission) / 100;
        $totalParcelas = $sumValueTax / $this->quantParcel;
        return $this->returnTaxObject($taxValue, $totalParcelas, $valueComis, $sumValueTax);
    }

    public function calculateCompTax($originalValue, $diasAtraso)
    {
        //valor Taxa de juros
        $tax =  ($this->tax / 100) * $diasAtraso;
        $taxValue = $originalValue * $tax;


        $value = 0;

        $i = 0;
        while ($i <  $this->quantParcel) {
            $value = $originalValue + $taxValue;
            $originalValue = $value;
            $taxValue = $originalValue * $tax;
            $i++;
        }

        $parcelas = $value / $this->quantParcel;
        $valueComis = ($value * $this->saleCommission) / 100;
        return $this->returnTaxObject($taxValue, $parcelas, $valueComis, $value);
    }


    public function returnTaxObject($taxValue, $totalParcelas, $valueComis, $sumValueTax)
    {
        $return = [];
        $return['taxValue'] = $taxValue;
        $return['valueComis'] = $valueComis;
        $return['totalValue'] = $sumValueTax;
        $return['totalParcels'] = Format::formatCoin($totalParcelas);
        return $return;
    }
}
