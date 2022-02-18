<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Models\Ticket;
use App\Service\GooApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();
        if ($request->q) {
            $query->orWhere('name', 'like', "%{$request->q}%")->orWhere('converted_name', 'like', "%{$request->q}%");
        }
        $tickets = $query->get();
        return view('admin.tickets', compact(['tickets']));
    }

    public function enter($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->entered_at = now();
        $ticket->save();
        return redirect()->route('tickets.index')->with('message', '入場処理を完了しました！');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index')->with('message', 'チケットを削除しました！');
    }

    public function sendMail($id)
    {
        $ticket = Ticket::findOrFail($id);
        Mail::to($ticket->email)->send(new InvitationMail($ticket));
        return redirect()->back()->with('message', 'メールを送信しました！');;
    }
}
