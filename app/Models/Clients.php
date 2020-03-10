<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Clients extends Model
{
    protected $collection = 'clients';
    protected $fillable = ['name', 'cpf'];

    /**
     * Lista todos os débitos do cliente
     *
     * @return array
     */
    public function debts()
    {
        return $this->hasMany(Debts::class, 'client_id', 'id');
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


    /**
     * Mutator para data
     *
     * @param [type] $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i');
    }
}
