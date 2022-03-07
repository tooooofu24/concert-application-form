<?php

namespace App\Console\Commands;

use App\Mail\SurveyMail;
use App\Models\Ticket;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSurveyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'アンケートメール送信コマンド';

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
        $tickets = Ticket::where('email', '<>', null)->where('entered_at', '<>', null)->get();
        foreach ($tickets as $i => $ticket) {
            print("{$i}/{$tickets->count()}\n");
            try {
                Mail::to($ticket->email)->send(new SurveyMail($ticket));
            } catch (Exception $e) {
                print($e->getMessage() . "\n");
                Log::debug($e->getMessage());
                Log::debug($ticket);
                continue;
            }
        }
        return 0;
    }
}
