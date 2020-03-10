<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Debts extends Model
{
    protected $collection = 'debts';
    protected $fillable = ['date_payment', 'value', 'client_id', 'quant_parcel'];

    public function clients()
    {
        return $this->belongsTo(Clients::class);
    }

    /**
     * Mutator para data
     *
     * @param [type] $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i');
    }

}
