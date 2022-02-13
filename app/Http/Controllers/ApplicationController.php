<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        return view('application.index');
    }

    /**
     * チケット申込の保存
     * 
     * @param Request $request
     * 
     * @return [type]
     */
    public function store(TicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->fill($request->all());
        $ticket->save();
        return redirect()->route('application.complete')->with('complete', true);
    }

    /**
     * チケットの表示
     * 
     * @param mixed $uid
     * 
     * @return [type]
     */
    public function show($uid)
    {
        $ticket = Ticket::where('uid', $uid)->firstOrFail();
        return view('application.ticket', compact(['ticket']));
    }

    public function complete()
    {
        if (!session('complete')) {
            return redirect()->route('application.index');
        }
        return view('application.complete');
    }
}
