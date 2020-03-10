<?php
// app/Repositories/PostRepository.php
namespace App\Repositories;

use App\Models\Clients;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientsRepository implements ClientRepositoryInterface
{
    protected $model;

    public function __construct(Clients $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc');
    }

    public function find($clientId)
    {
        return $this->model->where('id', $clientId)->with('debts');
    }

    public function save($data)
    {
        return $this->model->updateOrCreate($data);
    }
}
