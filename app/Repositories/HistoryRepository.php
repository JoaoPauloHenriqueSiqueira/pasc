<?php
// app/Repositories/PostRepository.php
namespace App\Repositories;

use App\Repositories\Contracts\HistoryRepositoryInterface;
use App\Models\History;

class HistoryRepository implements HistoryRepositoryInterface
{
    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function findAllByCompany($companyId)
    {
        return History::where('company_id', (int) $companyId)->where('closed', 0)->orderBy('updated_at', 'desc')->get();
    }

    public function find($historyId)
    {
        return History::find($historyId)->get();
    }

    public function save($request)
    {
        $company = array_get($request, "company_id");
        $session = array_get($request, "session");
        $closed = array_get($request, "closed", false);

        $history = History::firstOrNew(array('session' => $session));
        $history['company_id'] = $company;
        $history['closed'] = $closed;
        $history->save();

        return $history;
    }
}
