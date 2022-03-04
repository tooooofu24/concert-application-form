<?php

namespace App\Console\Commands;

use App\Mail\PreviousMail;
use App\Models\Ticket;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPreviousMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:previous';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日メール送信用コマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $tickets = Ticket::where('email', '<>', null)->get();
        $tickets = [Ticket::find(1)];
        foreach ($tickets as $ticket) {
            try {
                Mail::to($ticket->email)->send(new PreviousMail($ticket));
            } catch (Exception $e) {
                dump($e->getMessage());
                Log::debug($e->getMessage());
                Log::debug($ticket);
                continue;
            }
        }
        return 0;
    }
}
