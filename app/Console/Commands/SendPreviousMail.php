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
        $tickets = Ticket::where('email', '<>', null)->get();
        foreach ($tickets as $i => $ticket) {
            print("{$i}/{$tickets->count()}\n");
            try {
                Mail::to($ticket->email)->send(new PreviousMail($ticket));
            } catch (Exception $e) {
                print($e->getMessage() . "\n");
                Log::debug($e->getMessage());
                Log::debug($ticket);
                continue;
            }
            break;
        }
        return 0;
    }
}
