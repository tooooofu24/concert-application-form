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
        $query = Ticket::query()->orderBy('updated_at', 'DESC');
        if ($request->q) {
            $query->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', "%{$request->q}%")->orWhere('converted_name', 'like', "%{$request->q}%");
            });
        }
        if ($request->enter == 1) {
            $query->where('entered_at', null);
        }
        if ($request->enter == 2) {
            $query->where('entered_at', '<>', null);
        }
        if ($request->reserve == 1) {
            $query->where('tel_reserved_flag', 1);
        }
        if ($request->reserve == 2) {
            $query->where('tel_reserved_flag', 0);
        }
        $tickets = $query->paginate(20);
        return view('admin.tickets', compact(['tickets']));
    }

    public function enter($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->entered_at = now();
        $ticket->save();
        return redirect()->route('tickets.index', $request->query())->with('message', '入場処理が完了しました！');
    }

    public function destroy($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index', $request->query())->with('message', 'チケットを削除しました！');
    }

    public function sendMail($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        if ($ticket->email) {
            Mail::to($ticket->email)->send(new InvitationMail($ticket));
            return redirect()->route('tickets.index', $request->query())->with('message', 'メールを送信しました！');
        }
        return redirect()->route('tickets.index', $request->query())->with('message', 'メール送信に失敗しました。');
    }

    public function update($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->fill($request->all())->save();
        return redirect()->route('tickets.index', $request->query())->with('message', '更新しました！');
    }

    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->tel_reserved_flag = true;
        $ticket->fill($request->all())->save();
        return redirect()->route('tickets.index', $request->query())->with('message', 'チケットを作成しました！');
    }

    public function table()
    {
        $tickets = Ticket::orderByRaw('converted_name IS NULL ASC')
            ->orderBy('converted_name', 'ASC')->get();
        return view('admin.table', compact(['tickets']));
    }
}
