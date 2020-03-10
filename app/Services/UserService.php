<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getCompanyUser()
    {
        $user = Auth::user();
        return $user->company_id;
    }
}
