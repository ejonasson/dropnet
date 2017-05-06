<?php

namespace App\Console\Commands;

use App\Models\Emails\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dropnet:messages:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Any Messages that are queued';

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
     * @return mixed
     */
    public function handle()
    {
        $messages = Message::where('delivery_time', '<=', Carbon::now())
            ->where('sent', false)
            ->get();
        $messages->each(function ($message) {
            $message->send();
        });
    }
}
