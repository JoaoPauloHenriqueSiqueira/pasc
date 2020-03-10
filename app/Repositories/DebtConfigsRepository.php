<?php
// app/Repositories/PostRepository.php
namespace App\Repositories;

use App\Models\DebtConfigs;
use App\Repositories\Contracts\DebtConfigsRepositoryInterface;

class DebtConfigsRepository implements DebtConfigsRepositoryInterface
{
    protected $model;

    public function __construct(DebtConfigs $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc');
    }

    public function save($data)
    {
        $obj = $this->model->create($data);
        return $obj->save();
    }
}
