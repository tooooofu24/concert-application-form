<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ApiEnterController extends Controller
{
    function __invoke($uid)
    {
        $ticket = Ticket::where('uid', $uid)->firstOrFail();
        $ticket->entered_at = now();
        $ticket->save();
    }
}
