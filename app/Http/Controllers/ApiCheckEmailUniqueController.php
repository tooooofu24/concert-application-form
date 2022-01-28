<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ApiCheckEmailUniqueController extends Controller
{
    /**
     * メールアドレスが重複していなければtrueを返す
     * 
     * @param Request $request
     * 
     * @return bool
     */
    public function __invoke(Request $request): bool
    {
        if (Ticket::where('email', $request->email)->exists()) {
            return true;
        }
        return false;
    }
}
